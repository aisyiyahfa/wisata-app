<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Mail;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $reservasi = Reservasi::all();
        return view('pages.reservasi.tabel-reservasi.index', compact('reservasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.reservasi.tabel-reservasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate([
            'nama_ketua' => 'required|string|max:255',
            'jumlah_romobongan' => 'required|integer',
            'alamat_romobongan' => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'required|date_format:H:i', // Pastikan ini benar
            'email' => 'required|email',
            'status' => 'required|string',
        ]);
    
        Reservasi::create($request->all());
    
        return redirect()->route('reservasi.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('reservasi.edit', compact('reservasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_ketua' => 'required|string|max:255',
            'jumlah_rombongan' => 'required|integer',
            'alamat_rombongan' => 'required|string',
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'required|time',
            'email' => 'required|email',
            'status' => 'nullable|string',
        ]);

        $reservasi->update($request->all());
        return redirect()->route('pages.reservasi.tabel-reservasi.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservasi->delete();
        return redirect()->route('pages.reservasi.tabel-reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }

}
