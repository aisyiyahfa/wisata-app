<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disposisi;
use App\Models\Surat;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    public function index($surat_id)
    {
        $surat = Surat::findOrFail($surat_id);
        $disposisi = Disposisi::where('surat_id', $surat_id)->get();

        return view('pages.disposisi-surat.index', compact('surat', 'disposisi'));
    }
    public function create($surat_id)
    {
        $surat = Surat::findOrFail($surat_id);
        return view('pages.disposisi-surat.create', compact('surat'));
    }

    public function edit($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        return view('pages.disposisi-surat.edit', compact('disposisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'surat_id' => 'required',
            'penerima' => 'required',
            'isi_disposisi' => 'required',
            'tenggat_waktu' => 'required|date',
        ]);

        Disposisi::create([
            'surat_id' => $request->surat_id,
            'penerima' => $request->penerima,
            'isi_disposisi' => $request->isi_disposisi,
            'tenggat_waktu' => $request->tenggat_waktu ?? null,
            'sifat_status' => $request->sifat_status,
            'catatan' => $request->keterangan
        ]);

        return redirect()->route('disposisi.index', $request->surat_id)->with('success', 'Disposisi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'penerima' => 'required',
            'isi_disposisi' => 'required',
            'tenggat_waktu' => 'required|date',
        ]);

        $disposisi = Disposisi::findOrFail($id);
        $disposisi->update([
            'penerima' => $request->penerima,
            'isi_disposisi' => $request->isi_disposisi,
            'tenggat_waktu' => $request->tenggat_waktu ?? null,
            'sifat_status' => $request->sifat_status,
            'catatan' => $request->keterangan,
        ]);

        return redirect()->route('disposisi.index', $disposisi->surat_id)->with('success', 'Disposisi berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $disposisi->delete();

        return redirect()->route('disposisi.index', $disposisi->surat_id)->with('success', 'Disposisi berhasil dihapus.');
    }
}
