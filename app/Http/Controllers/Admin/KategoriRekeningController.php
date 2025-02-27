<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriRekening;

class KategoriRekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriRekenings = KategoriRekening::all();
        return view('pages.bendahara.kategori-rekening.index', compact('kategoriRekenings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_rekening' => 'required|string|max:255',
        ]);

        KategoriRekening::create($request->all());

        return redirect()->route('kategori-rekening.index')
                         ->with('success', 'Kategori rekening berhasil ditambahkan.');
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
        $kategoriRekening = KategoriRekening::findOrFail($id);
        return view('layouts.pages.bendahara.kategori_rekening.index', compact('kategoriRekening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori_rekening' => 'required|string|max:255',
        ]);

        $kategoriRekening = KategoriRekening::findOrFail($id);
        $kategoriRekening->update($request->all());

        return redirect()->route('kategori-rekening.index')
                         ->with('success', 'Kategori rekening berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategoriRekening = KategoriRekening::findOrFail($id);
        $kategoriRekening->delete();

        return redirect()->route('kategori-rekening.index')
                         ->with('success', 'Kategori rekening berhasil dihapus.');
    }
}
