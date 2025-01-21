<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::all();


        return view('pages.keuangan.pengeluaran.index', [
            'pengeluaran' => $pengeluaran
        ]);
    }

    public function pdf()  
    {  
        $pengeluaran = Pengeluaran::all();
        return view('pages.keuangan.pengeluaran.pdf',[
            'pengeluaran' => $pengeluaran
        ]);
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
        $pengeluaran = $request->all();

        Pengeluaran::create($pengeluaran);


        return redirect()->route('pengeluaran.index')->with('SuccessAlert', 'Data berhasil di tambahkan!!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengeluaran = Pengeluaran::find($id);

        $data = $request->all();

        $pengeluaran->update($data);

        toast('Data berhasil Update!!.', 'success');

        return redirect()->route('pengeluaran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengeluaran = Pengeluaran::find($id);

        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index');
    }
}
