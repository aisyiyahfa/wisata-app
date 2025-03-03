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
        return view('pages.bendahara.kategori-rekening.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_rekening' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:50|unique:kategori_rekenings,no_rekening',
        ]);

        KategoriRekening::create($request->only(['nama_kategori_rekening', 'no_rekening']));

        return redirect()->route('kategori-rekening.index')
                         ->with('success', 'Kategori rekening berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriRekening $kategoriRekening)
    {
        return view('pages.bendahara.kategori-rekening.show', compact('kategoriRekening'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriRekening $kategoriRekening)
    {
        return view('pages.bendahara.kategori-rekening.edit', compact('kategoriRekening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriRekening $kategoriRekening)
    {
        $request->validate([
            'nama_kategori_rekening' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:50|unique:kategori_rekenings,no_rekening,' . $kategoriRekening->id,
        ]);

        $kategoriRekening->update($request->only(['nama_kategori_rekening', 'no_rekening']));

        return redirect()->route('kategori-rekening.index')
                         ->with('success', 'Kategori rekening berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriRekening $kategoriRekening)
    {
        $kategoriRekening->delete();

        return redirect()->route('kategori-rekening.index')
                         ->with('success', 'Kategori rekening berhasil dihapus.');
    }
}
