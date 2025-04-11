<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Reservasi;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $tahunKeuangan = $request->input('tahun_keuangan', date('Y'));
        $tahunSurat = $request->input('tahun_surat', date('Y'));

        $totalPemasukan = Pemasukan::selectRaw('SUM(CAST(REPLACE(nominal, ".", "") AS UNSIGNED)) as total')
            ->whereYear('tanggal', $tahunKeuangan)
            ->value('total');

        $totalPengeluaran = Pengeluaran::selectRaw('SUM(CAST(REPLACE(nominal, ".", "") AS UNSIGNED)) as total')
            ->whereYear('tanggal', $tahunKeuangan)
            ->value('total');

        $dataPemasukan = array_fill(0, 12, 0);
        $dataPengeluaran = array_fill(0, 12, 0);

        $pemasukanPerBulan = Pemasukan::selectRaw('MONTH(tanggal) as bulan, SUM(CAST(REPLACE(nominal, ".", "") AS UNSIGNED)) as total')
            ->whereYear('tanggal', $tahunKeuangan)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $pengeluaranPerBulan = Pengeluaran::selectRaw('MONTH(tanggal) as bulan, SUM(CAST(REPLACE(nominal, ".", "") AS UNSIGNED)) as total')
            ->whereYear('tanggal', $tahunKeuangan)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Masukkan data ke dalam array sesuai dengan indeks yang benar
        foreach ($pemasukanPerBulan as $bulan => $total) {
            $dataPemasukan[$bulan - 1] = $total; // Kurangi 1 agar bulan Januari (1) masuk ke indeks 0
        }

        foreach ($pengeluaranPerBulan as $bulan => $total) {
            $dataPengeluaran[$bulan - 1] = $total;
        }

        // Label bulan untuk grafik
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $saldoKeuangan = $totalPemasukan - $totalPengeluaran;

        // Data Surat Menyurat
        $jumlahSurat = Surat::whereYear('tanggal_surat', $tahunSurat)->count();

        $suratMasukPerBulan = array_fill(0, 12, 0);
        $suratKeluarPerBulan = array_fill(0, 12, 0);

        $suratMasuk = Surat::where('tipe', 'masuk')
            ->whereYear('tanggal_surat', $tahunSurat)
            ->get();

        $suratKeluar = Surat::where('tipe', 'keluar')
            ->whereYear('tanggal_surat', $tahunSurat)
            ->get();

        foreach ($suratMasuk as $surat) {
            $bulan = (int) \Carbon\Carbon::parse($surat->tanggal_surat)->format('m');
            $suratMasukPerBulan[$bulan - 1]++;
        }

        foreach ($suratKeluar as $surat) {
            $bulan = (int) \Carbon\Carbon::parse($surat->tanggal_surat)->format('m');
            $suratKeluarPerBulan[$bulan - 1]++;
        }

        // Data Umum
        $jumlahPengunjung = Reservasi::where('status', 'disetujui')->sum('jumlah_rombongan');
        $jumlahUsers = User::count();

        return view('pages.admin.dashboard', compact(
            'jumlahUsers',
            'user',
            'saldoKeuangan',
            'jumlahPengunjung',
            'jumlahSurat',
            'totalPemasukan',
            'totalPengeluaran',
            'bulanLabels',
            'dataPemasukan',
            'dataPengeluaran',
            'tahunKeuangan',
            'tahunSurat',
            'suratMasukPerBulan',
            'suratKeluarPerBulan',
        ));
    }
}
