@extends('layouts.template')
@section('title', 'Surat Masuk')
@section('sub-title', 'Surat Masuk')

@section('content')
    <div class="container">
        <a href="{{ route('surat-masuk.create') }}" class="btn btn-outline-primary px-4 mb-4 shadow"
            style="border-radius: 25px;">
            <i class="fa fa-plus-circle"></i> Tambah surat masuk
        </a>
        @foreach ($surat as $item)
            <div class="card shadow" style="border-radius: 16px;">
                <div class="card-header">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div>
                            <h5>{{ $item->nomor_surat }}</h5>
                            <span>{{ $item->pengirim }} | Nomor Agenda: {{ $item->nomor_agenda }} |
                                {{ $item->kategori->nama }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="text-right mr-3">
                                <p class="m-0">Tanggal Surat</p>
                                <span>{{ \Carbon\Carbon::parse($item->tanggal_surat)->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                            </div>
                            <a href="{{ route('disposisi.index', $item->id) }}" class="btn btn-outline-primary px-4 shadow mx-2" style="border-radius: 25px;">
                                Disposisi Surat ({{ $item->disposisi->count() }})
                            </a>

                            <!-- Dropdown Bootstrap 4 -->
                            <div class="dropdown">
                                <button class="btn btn-light" type="button" id="dropdownMenuButton{{ $item->id }}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenuButton{{ $item->id }}">
                                    <a class="dropdown-item" href="{{ route('surat-masuk.show', $item->id) }}"><i
                                            class="fa fa-eye"></i> Lihat Detail</a>
                                    <a class="dropdown-item" href="{{ route('surat-masuk.edit', $item->id) }}"><i
                                            class="fa fa-edit"></i> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('surat-masuk.destroy', $item->id) }}" method="POST"
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
                    <p class="card-text">{{ $item->ringkasan }}</p>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted">{{ $item->keterangan }}</p>
                        </div>

                        <div>
                            @if ($item->lampiran)
                                <a href="{{ asset('/storage/' . $item->lampiran) }}" target="_blank">
                                    <i class="fa fa-file"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
