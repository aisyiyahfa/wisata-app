@extends('layouts.template')
@section('title', 'Surat Masuk')
@section('sub-title', 'Detail Surat Masuk')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow" style="border-radius: 16px;">
                    <div class="card-header">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div>
                                <h5>{{ $surat->nomor_surat }}</h5>
                                <span>{{ $surat->pengirim }} | Nomor Agenda: {{ $surat->nomor_agenda }} |
                                    {{ $surat->kategori->nama }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="text-right mr-3">
                                    <p class="m-0">Tanggal Surat</p>
                                    <span>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                                </div>

                                <!-- Dropdown Bootstrap 4 -->
                                <div class="dropdown">
                                    <button class="btn btn-light" type="button" id="dropdownMenuButton{{ $surat->id }}"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdownMenuButton{{ $surat->id }}">
                                        <a class="dropdown-item" href="{{ route('surat-masuk.show', $surat->id) }}"><i
                                                class="fa fa-eye"></i> Lihat Detail</a>
                                        <a class="dropdown-item" href="{{ route('surat-masuk.edit', $surat->id) }}"><i
                                                class="fa fa-edit"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('surat-masuk.destroy', $surat->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $surat->ringkasan }}</p>
                        <p class="text-muted">{{ $surat->keterangan }}</p>
                        
                        <hr>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="20%">Nomor Surat</th>
                                    <td>{{ $surat->nomor_surat }}</td>
                                </tr>
                                <tr>
                                    <th>Pengirim</th>
                                    <td>{{ $surat->pengirim }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Agenda</th>
                                    <td>{{ $surat->nomor_agenda ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Surat</th>
                                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Diterima</th>
                                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_diterima)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>{{ $surat->kategori->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Ringkasan</th>
                                    <td>{{ $surat->ringkasan }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>{{ $surat->keterangan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Lampiran</th>
                                    <td>
                                        @if ($surat->lampiran)
                                            <a href="{{ asset('storage/' . $surat->lampiran) }}" target="_blank"
                                                class="btn btn-outline-info btn-sm">Lihat Lampiran</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('surat-masuk.index') }}" class="btn btn-outline-secondary px-4 shadow"
                                style="border-radius: 25px;">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
