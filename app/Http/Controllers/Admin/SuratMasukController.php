<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratMasuk;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratMasuk = SuratMasuk::all();
        return view('pages.sekretaris.surat-masuk.index', compact('suratMasuk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.sekretaris.surat-masuk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validate and store the incoming letter
         $request->validate([
            'no_surat' => 'required|unique:surat_masuk',
            'instansi_pengirim' => 'required',
            'perihal' => 'required',
            'tgl_surat' => 'required|date',
            'diterima_tgl' => 'required|date',
            'lampiran' => 'nullable|string',
            'status' => 'required|in:1,2,3',
            'sifat' => 'required|in:1,2',
            'file_surat' => 'nullable|file',
        ]);

        // Store the file if uploaded
        if ($request->hasFile('file_surat')) {
            $filePath = $request->file('file_surat')->store('uploads/surat');
        }

        SuratMasuk::create([
            'no_surat' => $request->no_surat,
            'instansi_pengirim' => $request->instansi_pengirim,
            'perihal' => $request->perihal,
            'tgl_surat' => $request->tgl_surat,
            'diterima_tgl' => $request->diterima_tgl,
            'lampiran' => $request->lampiran,
            'status' => $request->status,
            'sifat' => $request->sifat,
            'file_surat' => $filePath ?? null,
        ]);

        return redirect()->route('surat-masuk.index')->with('msg', 'Surat Masuk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.sekretaris.surat-masuk.show', compact('suratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.sekretaris.surat-masuk.edit', compact('suratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate and update the incoming letter
        $request->validate([
            'no_surat' => 'required|unique:surat_masuk,no_surat,' . $suratMasuk->id,
            'instansi_pengirim' => 'required',
            'perihal' => 'required',
            'tgl_surat' => 'required|date',
            'diterima_tgl' => 'required|date',
            'lampiran' => 'nullable|string',
            'status' => 'required|in:1,2,3',
            'sifat' => 'required|in:1,2',
            'file_surat' => 'nullable|file',
        ]);

        // Store the file if uploaded
        if ($request->hasFile('file_surat')) {
            $filePath = $request->file('file_surat')->store('uploads/surat');
            $suratMasuk->file_surat = $filePath;
        }

        $suratMasuk->update($request->only('no_surat', 'instansi_pengirim', 'perihal', 'tgl_surat', 'diterima_tgl', 'lampiran', 'status', 'sifat'));

        return redirect()->route('surat-masuk.index')->with('msg', 'Surat Masuk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suratMasuk->delete();
        return redirect()->route('surat-masuk.index')->with('msg', 'Surat Masuk berhasil dihapus.');
    }
}
