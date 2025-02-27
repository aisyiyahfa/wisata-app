@extends('layouts.template')
@section('title', 'Surat Masuk')
@section('sub-title', 'Surat Disposisi')

@section('content')
    <div class="container">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            Disposisi untuk surat dengan nomor {{ $surat->nomor_surat }}<span
                class="font-weight-bold mx-2 text-decoration-none"><a href="{{ route('surat-masuk.show', $surat->id) }}">
                    Lihat Detail</a></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <a href="{{ route('disposisi.create', $surat->id) }}" class="btn btn-outline-primary px-4 mb-4 shadow"
            style="border-radius: 25px;">
            <i class="fa fa-plus-circle"></i> Tambah Baru
        </a>
        @foreach ($disposisi as $item)
            <div class="card shadow" style="border-radius: 16px;">
                <div class="card-header">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div>
                            <h5>{{ $item->sifat_status }}</h5>
                            <span>{{ $item->penerima }} </span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="text-right mr-3">
                                <p class="m-0">Tenggat Waktu</p>
                                <span>{{ \Carbon\Carbon::parse($item->tenggat_waktu)->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                            </div>
                            <!-- Dropdown Bootstrap 4 -->
                            <div class="dropdown">
                                <button class="btn btn-light" type="button" id="dropdownMenuButton{{ $item->id }}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenuButton{{ $item->id }}">
                                    <a class="dropdown-item" href="{{ route('disposisi.edit', $item->id) }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('disposisi.destroy', $item->id) }}" method="POST"
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
                    <p class="card-text">{{ $item->isi_disposisi }}</p>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted">{{ $item->keterangan }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
