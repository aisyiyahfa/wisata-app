@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold">
                            <i class="fas fa-calendar-plus"></i> Reservasi
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('reservasi.store') }}" method="POST">
                            @csrf
                            <div class="row d-flex justify-content-between">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama_ketua"><i class="fas fa-user"></i> Nama Ketua</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                            name="nama_ketua" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                        <input type="email" class="form-control" value="{{ Auth::user()->email }}"
                                            name="email" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah_rombongan"><i class="fas fa-users"></i> Jumlah Rombongan</label>
                                        <input type="number" class="form-control" name="jumlah_rombongan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_rombongan"><i class="fas fa-map-marker-alt"></i> Alamat Rombongan</label>
                                <textarea class="form-control" name="alamat_rombongan" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_kunjungan"><i class="fas fa-calendar-day"></i> Tanggal Kunjungan</label>
                                <input type="date" class="form-control" name="tanggal_kunjungan" id="tanggal_kunjungan"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="jam_kunjungan"><i class="fas fa-clock"></i> Pilih Jam Kunjungan</label><br>
                                @foreach ($jamReservasi as $jamReservasi)
                                    <button type="button"
                                        class="btn btn-outline-success badge mr-2 mb-2 p-3 px-4 font-lg jam-button"
                                        data-jam="{{ \Carbon\Carbon::parse($jamReservasi->jam)->format('H:i') }}">
                                        {{ \Carbon\Carbon::parse($jamReservasi->jam)->format('H:i') }}
                                    </button>
                                @endforeach
                            </div>
                            <input type="hidden" id="selected_jam" name="jam_kunjungan">

                            <button type="submit" class="btn btn-primary float-right">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="font-weight-bold text-center"><i class="fas fa-history"></i> Riwayat Reservasi</h5>
                    </div>
                    <div class="card-body">
                        @if ($riwayatReservasi->isEmpty())
                            <p class="text-center"><i class="fas fa-exclamation-circle"></i> Belum ada riwayat reservasi.
                            </p>
                        @else
                            <table class="table" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Ketua</th>
                                        <th>Jumlah Rombongan</th>
                                        <th>Alamat Rombongan</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Jam Kunjungan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayatReservasi as $reservasi)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $reservasi->nama_ketua }}</td>
                                            <td>{{ $reservasi->jumlah_rombongan }}</td>
                                            <td>{{ $reservasi->alamat_rombongan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reservasi->tanggal_kunjungan)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($reservasi->jam_kunjungan)->format('H:i') }}</td>
                                            <td>
                                                @switch($reservasi->status)
                                                    @case('Disetujui')
                                                        <span class="badge badge-success">
                                                            <i class="fas fa-check-circle"></i> Disetujui
                                                        </span>
                                                    @break

                                                    @case('Ditolak')
                                                        <span class="badge badge-warning">
                                                            <i class="fas fa-clock"></i> Ditolak
                                                        </span>
                                                    @break

                                                    @case('Dibatalkan')
                                                        <span class="badge badge-danger">
                                                            <i class="fas fa-times-circle"></i> Dibatalkan
                                                        </span>
                                                    @break

                                                    @default
                                                        <span class="badge badge-info">
                                                            <i class="fas fa-spinner"></i> Pending
                                                        </span>
                                                @endswitch
                                            </td>

                                            <td>
                                                @if ($reservasi->status == 'pending')
                                                    <a href="{{ route('reservasi.cancel', $reservasi->id) }}"
                                                        class="btn btn-danger">Batalkan</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function checkBooking(tanggal, jam) {
            return $.ajax({
                url: '{{ route('reservasi.cek') }}',
                method: 'GET',
                data: {
                    tanggal: tanggal,
                    jam: jam
                }
            });
        }

        $('#tanggal_kunjungan').on('change', function() {
            let tanggal = $(this).val();
            $('.jam-button').removeClass('btn-secondary text-dark').prop('disabled', false);

            $('.jam-button').each(function() {
                let jam = $(this).data('jam');

                checkBooking(tanggal, jam).done(function(response) {
                    if (response.isBooked) {
                        $(this).removeClass('btn-outline-success').addClass(
                            'btn-secondary text-dark font-weight-bold').prop('disabled', true);
                    }
                }.bind(this));
            });
        });

        const jamButtons = document.querySelectorAll('.jam-button');

        jamButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (!this.disabled) {
                    jamButtons.forEach(btn => btn.classList.remove('btn-success'));
                    this.classList.add('btn-success');
                    document.getElementById('selected_jam').value = this.getAttribute('data-jam');
                }
            });
        });
    </script>
@endsection
