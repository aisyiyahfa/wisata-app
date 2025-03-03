@extends('layouts.template')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Data Reservasi</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('reservasi.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            @php
                                use Carbon\Carbon;
                                Carbon::setLocale('id');
                                $bulanList = [
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember',
                                ];
                            @endphp

                            <select name="bulan" class="form-control">
                                <option value="">Pilih Bulan</option>
                                @foreach ($bulanList as $key => $bulan)
                                    <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>
                                        {{ $bulan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="tahun" value="{{ request('tahun') ?? date('Y') }}"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th class="text-center text-nowrap">Nama Ketua</th>
                                <th class="text-center text-nowrap">Jumlah Romobongan</th>
                                <th class="text-center text-nowrap">Alamat Romobongan</th>
                                <th class="text-center text-nowrap">Tanggal Kunjungan</th>
                                <th class="text-center text-nowrap">Jam Kunjungan</th>
                                <th class="text-center text-nowrap">Email</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_ketua }}</td>
                                    <td>{{ $item->jumlah_rombongan }}</td>
                                    <td>{{ $item->alamat_rombongan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->jam_kunjungan)->format('H:i') }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @switch($item->status)
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
                                        @if ($item->status == 'pending')
                                            <div class="d-flex">
                                                <a href="{{ route('reservasi.approve', $item->id) }}"
                                                    class="btn btn-success">Setujui</a>
                                                <a href="{{ route('reservasi.reject', $item->id) }}"
                                                    class="btn btn-danger ml-2">Tolak</a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
