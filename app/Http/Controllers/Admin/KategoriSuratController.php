<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriSurat;
use RealRashid\SweetAlert\Facades\Alert;

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

        Alert::success('Success', 'Kategori surat berhasil ditambahkan.');
        return redirect()->route('kategori-surat.index');
    }

    public function update(Request $request, KategoriSurat $kategoriSurat)
    {
        $request->validate([
            'nama' => 'required|string|max:255,' . $kategoriSurat->id,
        ]);

        $kategoriSurat->update($request->all());

        Alert::success('Success', 'Kategori surat berhasil diperbarui.');
        return redirect()->route('kategori-surat.index')->with('success', 'Kategori surat berhasil diperbarui.');
    }
    public function destroy(KategoriSurat $kategoriSurat)
    {
        $kategoriSurat->delete();

        Alert::success('Success', 'Kategori surat berhasil dihapus.');
        return redirect()->route('kategori-surat.index')->with('success', 'Kategori surat berhasil dihapus.');
    }
}
