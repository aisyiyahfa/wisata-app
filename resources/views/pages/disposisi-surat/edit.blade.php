@extends('layouts.template')
@section('title', 'Edit Disposisi')
@section('sub-title', 'Edit Disposisi')

@section('content')
    <div class="container">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            Edit Disposisi untuk surat dengan nomor {{ $disposisi->surat->nomor_surat }}
            <span class="font-weight-bold mx-2 text-decoration-none">
                <a href="{{ route('surat-masuk.show', $disposisi->surat->id) }}">Lihat Detail</a>
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="card shadow" style="border-radius: 16px;">
            <div class="card-body">
                <form action="{{ route('disposisi.update', $disposisi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="surat_id" value="{{ $disposisi->id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penerima">Penerima</label>
                                <input type="text" name="penerima" id="penerima" class="form-control"
                                    value="{{ $disposisi->penerima }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tenggat_waktu">Tenggat Waktu</label>
                                <input type="date" name="tenggat_waktu" id="tenggat_waktu" class="form-control"
                                    value="{{ $disposisi->tenggat_waktu }}" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="isi_disposisi">Isi Disposisi</label>
                                <textarea name="isi_disposisi" id="isi_disposisi" rows="3" class="form-control" required>{{ $disposisi->isi_disposisi }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sifat_status">Sifat Status</label>
                                <select name="sifat_status" id="sifat_status" class="form-control" required>
                                    <option value="">Pilih Sifat</option>
                                    <option value="Biasa" {{ $disposisi->sifat_status == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                                    <option value="Segera" {{ $disposisi->sifat_status == 'Segera' ? 'selected' : '' }}>Segera</option>
                                    <option value="Rahasia" {{ $disposisi->sifat_status == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control"
                                    value="{{ $disposisi->catatan }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('disposisi.index', $disposisi->surat->id) }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
