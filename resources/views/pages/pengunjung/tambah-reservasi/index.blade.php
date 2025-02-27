@extends('layouts.template')


@section('title', 'Tambah Reservasi')

@section('content_header')
    <h1>Tambah Reservasi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pengunjung.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_ketua">Nama Ketua:</label>
                    <input type="text" id="nama_ketua" name="nama_ketua" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_rombongan">Jumlah Rombongan:</label>
                    <input type="number" id="jumlah_rombongan" name="jumlah_rombongan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="alamat_rombongan">Alamat Rombongan:</label>
                    <input type="text" id="alamat_rombongan" name="alamat_rombongan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_kunjungan">Tanggal Kunjungan:</label>
                    <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jam_kunjungan">Jam Kunjungan:</label>
                    <select id="jam_kunjungan" name="jam_kunjungan" class="form-control" required>
                        <option value="">Pilih Jam</option>
                        <option value="08:00:00">08.00 - 10.00</option>
                        <option value="10:00:00">10.00 - 12.00</option>
                        <option value="12:00:00">12.00 - 14.00</option>
                        <option value="14:00:00">14.00 - 16.00</option>
                        <option value="16:00:00">16.00 - 18.00</option>
                        <option value="18:00:00">18.00 - 20.00</option>
                        <option value="20:00:00">20.00 - 22.00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        document.getElementById('tanggal_kunjungan').addEventListener('change', function() {
            const selectedDate = this.value;
            const jamSelect = document.getElementById('jam_kunjungan');
            jamSelect.innerHTML = '<option value="">Pilih Jam</option>';

            if (selectedDate) {
                fetch(`/api/available-jams?tanggal=${selectedDate}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(jam => {
                            const option = document.createElement('option');
                            option.value = jam;
                            option.textContent = jam.replace(':00:00', '').replace('-', ' - ');
                            jamSelect.appendChild(option);
                        });
                    })
                    <catch(error => console.error('Error fetching available jams:', error));
            }
        });
    </script>
@stop
