@extends('layouts.template')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Transaksi Surat</a></li>
                <li class="breadcrumb-item"><a href="{{ route('surat-keluar.index') }}">Surat Keluar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row d-flex">
                                <div class="col-md-4">
                                    <!-- Nomor Surat -->
                                    <div class="mb-3">
                                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                        <input type="text" name="nomor_surat"
                                            class="form-control @error('nomor_surat') is-invalid @enderror"
                                            value="{{ old('nomor_surat') }}" required>
                                        @error('nomor_surat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <!-- penerima -->
                                    <div class="mb-3">
                                        <label for="penerima" class="form-label">Penerima</label>
                                        <input type="text" name="penerima"
                                            class="form-control @error('penerima') is-invalid @enderror"
                                            value="{{ old('penerima') }}" required>
                                        @error('penerima')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <!-- Nomor Agenda -->
                                    <div class="mb-3">
                                        <label for="nomor_agenda" class="form-label">Nomor Agenda</label>
                                        <input type="text" name="nomor_agenda"
                                            class="form-control @error('nomor_agenda') is-invalid @enderror"
                                            value="{{ old('nomor_agenda') }}">
                                        @error('nomor_agenda')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <!-- Tanggal Surat -->
                                    <div class="mb-3">
                                        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                                        <input type="date" name="tanggal_surat"
                                            class="form-control @error('tanggal_surat') is-invalid @enderror"
                                            value="{{ old('tanggal_surat') }}" required>
                                        @error('tanggal_surat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- Ringkasan -->
                                    <div class="mb-3">
                                        <label for="ringkasan" class="form-label">Ringkasan</label>
                                        <textarea name="ringkasan" class="form-control @error('ringkasan') is-invalid @enderror" rows="3" required>{{ old('ringkasan') }}</textarea>
                                        @error('ringkasan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <!-- Kategori Surat -->
                                    <div class="mb-3">
                                        <label for="kategori_id" class="form-label">Kategori Surat</label>
                                        <select name="kategori_id"
                                            class="form-control @error('kategori_id') is-invalid @enderror" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori as $kategori)
                                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- Keterangan -->
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" name="keterangan"
                                            class="form-control @error('keterangan') is-invalid @enderror"
                                            value="{{ old('keterangan') }}">
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- Lampiran -->
                                    <div class="mb-3">
                                        <label for="lampiran" class="form-label">Lampiran </label>
                                        <input type="file" name="lampiran"
                                            class="form-control @error('lampiran') is-invalid @enderror" multiple>
                                        @error('lampiran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-outline-primary px-4 shadow" style="border-radius: 25px;">Simpan</button>
                                <a href="{{ route('surat-keluar.index') }}" class="btn btn-outline-secondary px-4 shadow" style="border-radius: 25px;">Batal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
