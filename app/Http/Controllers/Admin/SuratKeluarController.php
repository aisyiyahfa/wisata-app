<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriSurat;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $surat = Surat::where('tipe', 'keluar')->orderBy('created_at', 'desc')->get();
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
            'nomor_surat' => [
                'required',
                Rule::unique('surat')->where(function ($query) use ($request) {
                    return $query->where('tipe', 'keluar');
                })
            ],
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

        Alert::success('Success', 'Surat berhasil ditambahkan.');
        return redirect()->route('surat-keluar.index');
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
            'nomor_surat' => [
                'required',
                Rule::unique('surat')->where(function ($query) use ($request) {
                    return $query->where('tipe', 'keluar');
                })->ignore($surat->id),
            ],
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

        Alert::success('Success', 'Surat berhasil diperbarui.');
        return redirect()->route('surat-keluar.index');
    }


    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        Alert::success('Success', 'Surat berhasil dihapus.');
        return redirect()->route('surat-keluar.index');
    }
}
