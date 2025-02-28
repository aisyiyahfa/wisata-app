@extends('layouts.template')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Transaksi Surat</a></li>
                <li class="breadcrumb-item"><a href="{{ route('surat-masuk.index') }}">Surat Masuk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Surat</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('surat-masuk.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row d-flex">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                        <input type="text" name="nomor_surat"
                                            class="form-control @error('nomor_surat') is-invalid @enderror"
                                            value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
                                        @error('nomor_surat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="pengirim" class="form-label">Pengirim</label>
                                        <input type="text" name="pengirim"
                                            class="form-control @error('pengirim') is-invalid @enderror"
                                            value="{{ old('pengirim', $surat->pengirim) }}" required>
                                        @error('pengirim')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nomor_agenda" class="form-label">Nomor Agenda</label>
                                        <input type="text" name="nomor_agenda"
                                            class="form-control @error('nomor_agenda') is-invalid @enderror"
                                            value="{{ old('nomor_agenda', $surat->nomor_agenda) }}">
                                        @error('nomor_agenda')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                                        <input type="date" name="tanggal_surat"
                                            class="form-control @error('tanggal_surat') is-invalid @enderror"
                                            value="{{ old('tanggal_surat', $surat->tanggal_surat) }}" required>
                                        @error('tanggal_surat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_diterima" class="form-label">Tanggal Diterima</label>
                                        <input type="date" name="tanggal_diterima"
                                            class="form-control @error('tanggal_diterima') is-invalid @enderror"
                                            value="{{ old('tanggal_diterima', $surat->tanggal_diterima) }}" required>
                                        @error('tanggal_diterima')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="ringkasan" class="form-label">Ringkasan</label>
                                        <textarea name="ringkasan" class="form-control @error('ringkasan') is-invalid @enderror" rows="3" required>{{ old('ringkasan', $surat->ringkasan) }}</textarea>
                                        @error('ringkasan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="kategori_id" class="form-label">Kategori Surat</label>
                                        <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}" {{ $surat->kategori_id == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" name="keterangan"
                                            class="form-control @error('keterangan') is-invalid @enderror"
                                            value="{{ old('keterangan', $surat->keterangan) }}">
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="lampiran" class="form-label">Lampiran</label>
                                        <input type="file" name="lampiran" class="form-control @error('lampiran') is-invalid @enderror">
                                        @error('lampiran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-outline-success px-4 shadow" style="border-radius: 25px;">Update</button>
                                <a href="{{ route('surat-masuk.index') }}" class="btn btn-outline-secondary px-4 shadow" style="border-radius: 25px;">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
