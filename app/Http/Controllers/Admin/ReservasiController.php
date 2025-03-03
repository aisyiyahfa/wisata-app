<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ReservasiDisetujui;
use App\Models\JamReservasi;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class ReservasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservasi::query();

        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('tanggal_kunjungan', $request->bulan)
                ->whereYear('tanggal_kunjungan', $request->tahun);
        }

        $reservasi = $query->get();

        return view('pages.reservasi.tabel-reservasi.index', compact('reservasi'));
    }


    public function create()
    {
        $jamReservasi = JamReservasi::all();
        $riwayatReservasi = Reservasi::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('pages.reservasi.tabel-reservasi.create', compact('jamReservasi', 'riwayatReservasi'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_ketua' => 'required|string',
            'jumlah_rombongan' => 'required|integer|min:1',
            'alamat_rombongan' => 'required|string',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
            'jam_kunjungan' => 'required',
            'email' => 'required|email'
        ]);

        $cekReservasi = Reservasi::where('tanggal_kunjungan', $request->tanggal_kunjungan)
            ->where('jam_kunjungan', $request->jam_kunjungan)
            ->whereIn('status', ['pending', 'disetujui'])
            ->exists();

        if ($cekReservasi) {
            return redirect()->back()->with('error', 'Jam kunjungan pada tanggal tersebut sudah dipesan.');
        }

        Reservasi::create([
            'nama_ketua' => $request->nama_ketua,
            'jumlah_rombongan' => $request->jumlah_rombongan,
            'alamat_rombongan' => $request->alamat_rombongan,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'jam_kunjungan' => $request->jam_kunjungan,
            'email' => $request->email,
            'user_id' => Auth::user()->id
        ]);

        Alert::success('Success', 'Reservasi berhasil dibuat.');
        return redirect()->back()->with('success', 'Reservasi berhasil dibuat.');
    }
    public function approve($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status' => 'Disetujui']);

        Mail::to($reservasi->user->email)->send(new ReservasiDisetujui($reservasi));

        Alert::success('Success', 'Reservasi disetujui dan email telah dikirim.');
        return redirect()->route('reservasi.index')->with('success', 'Reservasi disetujui dan email telah dikirim.');
    }

    public function reject($id)
    {
        $jamReservasi = Reservasi::findOrFail($id);
        $jamReservasi->status = 'Ditolak'; 
        $jamReservasi->save();

        return redirect()->back()->with('success', 'Jam reservasi telah ditolak.');
    }
    public function cancel($id)
    {
        $jamReservasi = Reservasi::findOrFail($id);
        $jamReservasi->status = 'Dibatalkan'; 
        $jamReservasi->save();

        return redirect()->back()->with('success', 'Jam reservasi telah dibatalkan.');
    }


    public function cekReservasi(Request $request)
    {
        $tanggal = $request->tanggal;
        $jam = $request->jam;
    
        $isBooked = Reservasi::where('tanggal_kunjungan', $tanggal)
            ->where('jam_kunjungan', $jam)
            ->whereIn('status', ['pending', 'disetujui'])
            ->exists();
    
        return response()->json(['isBooked' => $isBooked]);
    }
    
}
