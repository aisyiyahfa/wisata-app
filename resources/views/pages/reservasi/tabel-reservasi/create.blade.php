@extends('layouts.template')

@section('content')
<div class="container">
    <h2>Tambah Reservasi</h2>

    <form action="{{ route('reservasi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_ketua">Nama Ketua</label>
            <input type="text" class="form-control" name="nama_ketua" required>
        </div>
        <div class="form-group">
            <label for="jumlah_rombongan">Jumlah Rombongan</label>
            <input type="number" class="form-control" name="jumlah_rombongan" required>
        </div>
        <div class="form-group">
            <label for="alamat_rombongan">Alamat Rombongan</label>
            <textarea class="form-control" name="alamat_rombongan" required></textarea>
        </div>
        <div class="form-group">
            <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
            <input type="date" class="form-control" name="tanggal_kunjungan" required>
        </div>
        <div class="form-group">
            <label for="jam_kunjungan">Jam Kunjungan</label>
            <input type="time" class="form-control" name="jam_kunjungan" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" name="status" value="pending">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
