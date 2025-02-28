<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriSurat;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class SuratMasukController extends Controller
{
    public function index()
    {
        $surat = Surat::where('tipe', 'masuk')->get();
        return view('pages.surat-masuk.index', compact('surat'));
    }

    public function create()
    {
        $kategori = KategoriSurat::all();
        return view('pages.surat-masuk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => [
                'required',
                Rule::unique('surat')->where(function ($query) use ($request) {
                    return $query->where('tipe', 'masuk');
                })
            ],
            'pengirim' => 'required',
            'nomor_agenda' => 'nullable',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'ringkasan' => 'required',
            'kategori_id' => 'required|exists:kategori_surat,id',
            'keterangan' => 'nullable',
            'lampiran' => 'nullable|max:2048',
        ]);

        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('suratMasuk', 'public');
        }

        Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'pengirim' => $request->pengirim,
            'nomor_agenda' => $request->nomor_agenda,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_diterima' => $request->tanggal_diterima,
            'ringkasan' => $request->ringkasan,
            'kategori_id' => $request->kategori_id,
            'keterangan' => $request->keterangan,
            'tipe' => 'masuk',
            'lampiran' => $lampiranPath ?? null,
        ]);

        Alert::success('Success', 'Surat berhasil ditambahkan.');
        return redirect()->route('surat-masuk.index');
    }


    public function show($id)
    {
        $surat = Surat::find($id);
        return view('pages.surat-masuk.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = Surat::find($id);
        $kategori = KategoriSurat::all();
        return view('pages.surat-masuk.edit', compact('surat', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::find($id);

        $request->validate([
            'nomor_surat' => [
                'required',
                Rule::unique('surat')->where(function ($query) use ($request) {
                    return $query->where('tipe', 'masuk');
                })->ignore($surat->id),
            ],
            'pengirim' => 'required',
            'nomor_agenda' => 'nullable',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'ringkasan' => 'required',
            'kategori_id' => 'required|exists:kategori_surat,id',
            'keterangan' => 'nullable',
            'lampiran' => 'nullable|max:2048',
        ]);

        $data = $request->only([
            'nomor_surat',
            'pengirim',
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
            $data['lampiran'] = $request->file('lampiran')->store('suratMasuk', 'public');
        }

        $surat->update($data);

        Alert::success('Success', 'Surat berhasil diperbarui.');
        return redirect()->route('surat-masuk.index');
    }


    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        Alert::success('Success', 'Surat berhasil dihapus.');
        return redirect()->route('surat-masuk.index');
    }
}
