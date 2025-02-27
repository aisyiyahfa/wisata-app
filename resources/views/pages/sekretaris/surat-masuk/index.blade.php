@extends('layouts.template')

@section('title', 'Reservasi')

@section('content_header')
    <h1>Data Reservasi</h1>
@stop

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Daftar Reservasi</h4>
                <button class="btn btn-md btn-outline-primary float-right" data-toggle="modal" data-target="#addReservationModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Reservasi
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="reservationTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Ketua</th>
                                <th>Jumlah Rombongan</th>
                                <th>Alamat Rombongan</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Jam Kunjungan</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasis as $reservasi)
                                <tr>
                                    <td>{{ $reservasi->nama_ketua }}</td>
                                    <td>{{ $reservasi->jumlah_rombongan }}</td>
                                    <td>{{ $reservasi->alamat_rombongan }}</td>
                                    <td>{{ $reservasi->tanggal_kunjungan->toDateString() }}</td>
                                    <td>{{ $reservasi->jam_kunjungan->format('H:i') }}</td>
                                    <td>{{ $reservasi->email }}</td>
                                    <td>{{ $reservasi->status }}</td>
                                    <td>
                                        <a href="{{ route('admin.edit', $reservasi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.delete', $reservasi->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Tambah Reservasi -->
    <div class="modal fade" id="addReservationModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Reservasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_ketua">Nama Ketua:</label>
                            <input type="text" class="form-control" name="nama_ketua" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_rombongan">Jumlah Rombongan:</label>
                            <input type="number" class="form-control" name="jumlah_rombongan" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_rombongan">Alamat Rombongan:</label>
                            <input type="text" class="form-control" name="alamat_rombongan" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_kunjungan">Tanggal Kunjungan:</label>
                            <input type="date" class="form-control" name="tanggal_kunjungan" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_kunjungan">Jam Kunjungan:</label>
                            <input type="time" class="form-control" name="jam_kunjungan" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#reservationTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop
