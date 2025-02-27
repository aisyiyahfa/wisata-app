<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriSurat;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $surat = Surat::where('tipe', 'keluar')->get();
        return view('pages.surat-keluar.index', compact('surat'));
    }

    public function create()
    {
        $kategori = KategoriSurat::all();
        return view('pages.surat-keluar.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat',
            'penerima' => 'required',
            'nomor_agenda' => 'nullable',
            'tanggal_surat' => 'required|date',
            'ringkasan' => 'required',
            'kategori_id' => 'required|exists:kategori_surat,id',
            'keterangan' => 'nullable',
            'lampiran' => 'nullable|max:2048',
        ]);

        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('suratkeluar', 'public');
        }

        Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'penerima' => $request->penerima,
            'nomor_agenda' => $request->nomor_agenda,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_diterima' => now(),
            'ringkasan' => $request->ringkasan,
            'kategori_id' => $request->kategori_id,
            'keterangan' => $request->keterangan,
            'tipe' => 'keluar',
            'lampiran' => $lampiranPath ?? null,
        ]);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil ditambahkan.');
    }


    public function show($id)
    {
        $surat = Surat::find($id);
        return view('pages.surat-keluar.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = Surat::find($id);
        $kategori = KategoriSurat::all();
        return view('pages.surat-keluar.edit', compact('surat', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::find($id);

        $request->validate([
            'nomor_surat' => 'required',
            'penerima' => 'required',
            'nomor_agenda' => 'nullable',
            'tanggal_surat' => 'required|date',
            'ringkasan' => 'required',
            'kategori_id' => 'required|exists:kategori_surat,id',
            'keterangan' => 'nullable',
            'lampiran' => 'nullable|max:2048',
        ]);

        $data = $request->only([
            'nomor_surat',
            'penerima',
            'nomor_agenda',
            'tanggal_surat',
            'tanggal_diterima',
            'ringkasan',
            'kategori_id',
            'keterangan'
        ]);

        if ($request->hasFile('lampiran')) {
            if ($surat->lampiran) {
                Storage::delete('public/' . $surat->lampiran);
            }
            $data['lampiran'] = $request->file('lampiran')->store('suratkeluar', 'public');
        }

        $surat->update($data);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();
        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil dihapus.');
    }
}
