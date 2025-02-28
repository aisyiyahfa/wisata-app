@extends('layouts.template')

@section('title', 'Buku Agenda')
@section('sub-title', 'Surat')

@section('content')
    <div class="container">
        <div class="card shadow" style="border-radius: 16px;">
            <div class="card-body">
                <form action="{{ route('agenda.index') }}" method="GET">
                    <div class="row">
                        <!-- Filter Tipe -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tipe">Tipe Surat</label>
                                <select name="tipe" id="tipe" class="form-control select2">
                                    <option value="">Semua</option>
                                    <option value="Masuk" {{ request('tipe') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="Keluar" {{ request('tipe') == 'Keluar' ? 'selected' : '' }}>Keluar
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Filter Start Date -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_date">Dari Tanggal</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                        </div>

                        <!-- Filter End Date -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end_date">Sampai Tanggal</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                        </div>

                        <!-- Filter Kategori -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kategori_id">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control select2">
                                    <option value="">Semua</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}"
                                            {{ request('kategori_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                        <a href="{{ route('agenda.index') }}" class="btn btn-secondary"><i class="fa fa-sync"></i> Reset</a>
                        <a href="{{ route('agenda.index', array_merge(request()->all(), ['cetak' => 'pdf'])) }}"
                            target="_blank" class="btn btn-danger">
                            <i class="fa fa-file-pdf"></i> Cetak PDF
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow mt-4" style="border-radius: 16px;">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="example1">
                        <thead class="table-primary">
                            <tr>
                                <th>Nomor Agenda</th>
                                <th>Nomor Surat</th>
                                <th>Tipe</th>
                                <th>Tanggal Surat</th>

                                @if (request('tipe') == 'Masuk')
                                    <th>Pengirim</th>
                                @elseif(request('tipe') == 'Keluar')
                                    <th>Penerima</th>
                                @else
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                @endif

                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surat as $item)
                                <tr>
                                    <td>{{ $item->nomor_agenda }}</td>
                                    <td>{{ $item->nomor_surat }}</td>
                                    <td><span class="badge badge-pill py-2 px-3 text-capitalize badge-{{ $item->tipe == 'masuk' ? 'success' : 'danger' }}"> {{ $item->tipe  }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                    </td>

                                    @if (request('tipe') == 'Masuk')
                                        <td>{{ $item->pengirim }}</td>
                                    @elseif(request('tipe') == 'Keluar')
                                        <td>{{ $item->penerima }}</td>
                                    @else
                                        <td>{{ $item->pengirim }}</td>
                                        <td>{{ $item->penerima }}</td>
                                    @endif

                                    <td>{{ $item->kategori->nama ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
