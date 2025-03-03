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
        $tahun = $request->input('tahun', date('Y')); // Default tahun saat ini

        $totalPemasukan = Pemasukan::whereYear('created_at', $tahun)->sum('nominal');
        $totalPengeluaran = Pengeluaran::whereYear('created_at', $tahun)->sum('nominal');

        $pemasukanPerBulan = Pemasukan::selectRaw('MONTH(created_at) as bulan, SUM(nominal) as total')
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $pengeluaranPerBulan = Pengeluaran::selectRaw('MONTH(created_at) as bulan, SUM(nominal) as total')
            ->whereYear('created_at', $tahun)
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

        $jumlahPengunjung = Reservasi::where('status', 'disetujui')->sum('jumlah_rombongan');
        $jumlahUsers = User::count();
        $jumlahSurat = Surat::count();

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
            'tahun'
        ));
    }
}
