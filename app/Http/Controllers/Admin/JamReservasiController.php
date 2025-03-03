<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamReservasi;
use Illuminate\Http\Request;
use App\Models\KategoriSurat;
use RealRashid\SweetAlert\Facades\Alert;

class JamReservasiController extends Controller
{
    public function index()
    {
        $data = JamReservasi::latest()->get();
        return view('pages.jam-reservasi.index', compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'jam' => 'required',
        ]);

        JamReservasi::create($request->all());

        Alert::success('Success', 'Jam Reservasi berhasil ditambahkan.');
        return redirect()->route('jam-reservasi.index');
    }

    public function update(Request $request, JamReservasi $JamReservasi)
    {
        $request->validate([
            'jam' => 'required',
        ]);

        $JamReservasi->update($request->all());

        Alert::success('Success', 'Jam Reservasi berhasil diperbarui.');
        return redirect()->route('jam-reservasi.index')->with('success', 'Jam Reservasi berhasil diperbarui.');
    }
    public function destroy(JamReservasi $JamReservasi)
    {
        $JamReservasi->delete();

        Alert::success('Success', 'Jam Reservasi berhasil dihapus.');
        return redirect()->route('jam-reservasi.index')->with('success', 'Jam Reservasi berhasil dihapus.');
    }
}
