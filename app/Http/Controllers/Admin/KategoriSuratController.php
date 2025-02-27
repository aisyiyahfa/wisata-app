<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriSurat;

class KategoriSuratController extends Controller
{
    public function index()
    {
        $kategori = KategoriSurat::latest()->get();
        return view('pages.kategori-surat.index', compact('kategori'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KategoriSurat::create($request->all());

        return redirect()->route('kategori-surat.index')->with('success', 'Kategori surat berhasil ditambahkan.');
    }

    public function update(Request $request, KategoriSurat $kategoriSurat)
    {
        $request->validate([
            'nama' => 'required|string|max:255,' . $kategoriSurat->id,
        ]);

        $kategoriSurat->update($request->all());

        return redirect()->route('kategori-surat.index')->with('success', 'Kategori surat berhasil diperbarui.');
    }
    public function destroy(KategoriSurat $kategoriSurat)
    {
        $kategoriSurat->delete();
        return redirect()->route('kategori-surat.index')->with('success', 'Kategori surat berhasil dihapus.');
    }
}
