<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
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
=======
use App\Models\KategoriSurat;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'nomor_surat' => 'required|unique:surat',
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
            'nomor_surat' => 'required',
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
>>>>>>> main2
    }
}
