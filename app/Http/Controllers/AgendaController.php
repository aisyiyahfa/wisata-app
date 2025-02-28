<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $surat = Surat::query();

        if ($request->filled('tipe')) {
            $surat->where('tipe', $request->tipe);
        }
        if ($request->filled('start_date')) {
            $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date)->format('Y-m-d');
            $surat->whereDate('tanggal_surat', '>=', $startDate);
        }
        if ($request->filled('end_date')) {
            $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date)->format('Y-m-d');
            $surat->whereDate('tanggal_surat', '<=', $endDate);
        }
        if ($request->filled('kategori_id')) {
            $surat->where('kategori_id', $request->kategori_id);
        }

        $surat = $surat->orderBy('created_at', 'desc')->get();

        if ($request->has('cetak') && $request->cetak == 'pdf') {
            $pdf = Pdf::loadView('pages.agenda.pdf', compact('surat'));
            return $pdf->stream('buku_agenda.pdf');
        }
        $kategori = KategoriSurat::all();

        return view('pages.agenda.index', compact('surat', 'kategori'));
    }
}
