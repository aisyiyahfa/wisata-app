<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemasukan = Pemasukan::all();

        return view('pages.keuangan.pemasukan.index', [
            'pemasukan' => $pemasukan
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
        $data = $request->all();
        Pemasukan::create($data);

        return redirect()->route('pemasukan.index');
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
        $pemasukan = Pemasukan::find($id);

        $data = $request->all();

        $pemasukan->update($data);

        return redirect()->route('pemasukan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemasukan = Pemasukan::find($id);

        $pemasukan->delete();

        return redirect()->route('pemasukan.index')->with('succcess', "Data Berhasil Di Hapus!!");
    }
      
    public function generatePDF()  
    {  
        $pemasukan = Pemasukan::all(); // Ambil semua data pemasukan  
        dd($pemasukan); // Debugging  
        $pdf = PDF::loadView('pemasukan.pdf', compact('pemasukan'));  
        return $pdf->download('data_pemasukan.pdf');  
    }  
 
}
