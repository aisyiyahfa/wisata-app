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

        // Ambil tahun untuk masing-masing report secara terpisah
        $tahunKeuangan = $request->input('tahun_keuangan', date('Y'));
        $tahunSurat = $request->input('tahun_surat', date('Y'));

        // Data Keuangan (Hanya jika ada filter tahun_keuangan)
        $totalPemasukan = Pemasukan::whereYear('tanggal', $tahunKeuangan)->sum('nominal');
        $totalPengeluaran = Pengeluaran::whereYear('tanggal', $tahunKeuangan)->sum('nominal');

        $pemasukanPerBulan = Pemasukan::selectRaw('MONTH(tanggal) as bulan, SUM(nominal) as total')
            ->whereYear('tanggal', $tahunKeuangan)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $pengeluaranPerBulan = Pengeluaran::selectRaw('MONTH(tanggal) as bulan, SUM(nominal) as total')
            ->whereYear('tanggal', $tahunKeuangan)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $dataPemasukan = [];
        $dataPengeluaran = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataPemasukan[] = $pemasukanPerBulan[$i] ?? 0;
            $dataPengeluaran[] = $pengeluaranPerBulan[$i] ?? 0;
        }

        $saldoKeuangan = $totalPemasukan - $totalPengeluaran;

        // Data Surat Menyurat (Hanya jika ada filter tahun_surat)
        $jumlahSurat = Surat::whereYear('tanggal_surat', $tahunSurat)->count();
        $dataSuratMasuk = Surat::where('tipe', 'masuk')->whereYear('tanggal_surat', $tahunSurat)->get();
        $dataSuratKeluar = Surat::where('tipe', 'keluar')->whereYear('tanggal_surat', $tahunSurat)->get();

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
            'dataSuratMasuk',
            'dataSuratKeluar'
        ));
    }
}
