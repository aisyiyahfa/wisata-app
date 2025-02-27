<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\KategoriRekening;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with(['kategori', 'kategoriRekening'])->get();
        $kategoris = Kategori::all();
        $kategoriRekenings = KategoriRekening::all();

        return view('pages.bendahara.transaksi.index', compact('transaksis', 'kategoris', 'kategoriRekenings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $kategoriRekenings = KategoriRekening::all();

        return view('pages.bendahara.transaksi.create', compact('kategoris', 'kategoriRekenings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'kategori_id' => 'required|exists:kategoris,id',
            'kategori_rekening_id' => 'required|exists:kategori_rekenings,id',
            'nominal' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);
    
        $transaksi = new Transaksi();
        $transaksi->tanggal = $request->tanggal;
        $transaksi->jenis = $request->jenis;
        $transaksi->kategori_id = $request->kategori_id;
        $transaksi->kategori_rekening_id = $request->kategori_rekening_id;
        $transaksi->keterangan = $request->keterangan;
    
        if ($request->jenis == 'pemasukan') {
            $transaksi->pemasukan = $request->nominal;
            $transaksi->pengeluaran = 0; // atau null, sesuai kebutuhan
        } else {
            $transaksi->pengeluaran = $request->nominal;
            $transaksi->pemasukan = 0; // atau null, sesuai kebutuhan
        }
    
        $transaksi->save();
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.bendahara.transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategoris = Kategori::all();
        $kategoriRekenings = KategoriRekening::all();

        return view('pages.bendahara.transaksi.edit', compact('transaksi', 'kategoris', 'kategoriRekenings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->tanggal = $request->tanggal;
        // ... kolom lainnya ...
    
        if ($request->jenis == 'pemasukan') {
            $transaksi->pemasukan = $request->nominal;
            $transaksi->pengeluaran = 0; // Pastikan pengeluaran di-reset jika jenisnya pemasukan
        } else {
            $transaksi->pengeluaran = $request->nominal;
            $transaksi->pemasukan = 0; // Pastikan pemasukan di-reset jika jenisnya pengeluaran
        }
    
        $transaksi->save();
    
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi berhasil dihapus.');
    }
}
