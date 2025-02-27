@extends('layouts.template')
@section('title', 'Tambah Disposisi')
@section('sub-title', 'Tambah Disposisi Baru')

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
        <div class="card shadow" style="border-radius: 16px;">
            <div class="card-body">
                <form action="{{ route('disposisi.store', $surat->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="surat_id" value="{{ $surat->id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penerima">Penerima</label>
                                <input type="text" name="penerima" id="penerima" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tenggat_waktu">Tenggat Waktu</label>
                                <input type="date" name="tenggat_waktu" id="tenggat_waktu" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="isi_disposisi">Isi Disposisi</label>
                                <textarea name="isi_disposisi" id="isi_disposisi" rows="3" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sifat_status">Sifat Status</label>
                                <select name="sifat_status" id="sifat_status" class="form-control" required>
                                    <option value="">Pilih Sifat</option>
                                    <option value="Biasa">Biasa</option>
                                    <option value="Segera">Segera</option>
                                    <option value="Rahasia">Rahasia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                            </div>
                        </div>
                    </div>



                    <div class="text-right">
                        <a href="{{ route('surat-masuk.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
