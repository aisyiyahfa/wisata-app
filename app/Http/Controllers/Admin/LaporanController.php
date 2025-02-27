<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\KategoriRekening;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::all();
        $kategoriRekenings = KategoriRekening::all();

        $transaksis = Transaksi::with(['kategori', 'kategoriRekening']);

        if ($request->has('dari_tanggal') && $request->has('sampai_tanggal')) {
            $transaksis->whereBetween('tanggal', [$request->dari_tanggal, $request->sampai_tanggal]);
        }

        if ($request->has('kategori_id')) {
            $transaksis->where('kategori_id', $request->kategori_id);
        }

        if ($request->has('kategori_rekening_id')) {
            $transaksis->where('kategori_rekening_id', $request->kategori_rekening_id);
        }

        $transaksis = $transaksis->get();

        $totalPemasukan = $transaksis->sum('pemasukan');
        $totalPengeluaran = $transaksis->sum('pengeluaran');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;


        return view('pages.bendahara.laporan.index', compact('transaksis', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir',  'kategoris', 'kategoriRekenings')); 
    }
    public function filter(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'dari_tanggal' => 'nullable|date',
            'sampai_tanggal' => 'nullable|date|after_or_equal:dari_tanggal',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'kategori_rekening_id' => 'nullable|exists:kategori_rekenings,id',
        ]);

        // Query untuk mengambil data transaksi berdasarkan filter
        $query = Transaksi::query();

        if ($request->filled('dari_tanggal')) {
            $query->where('tanggal', '>=', $request->dari_tanggal);
        }

        if ($request->filled('sampai_tanggal')) {
            $query->where('tanggal', '<=', $request->sampai_tanggal);
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('kategori_rekening_id')) {
            $query->where('kategori_rekening_id', $request->kategori_rekening_id);
        }

        $transaksis = $query->get();

        // Menghitung total pemasukan, pengeluaran, dan saldo akhir
        $totalPemasukan = $transaksis->sum('pemasukan');
        $totalPengeluaran = $transaksis->sum('pengeluaran');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // Mengambil semua kategori dan kategori rekening untuk dropdown
        $kategoris = Kategori::all();
        $kategoriRekenings = KategoriRekening::all();

        // Mengirim data ke view
        return view('pages.bendahara.laporan.index', compact('transaksis', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir',  'kategoris', 'kategoriRekenings')); 
    }


}
