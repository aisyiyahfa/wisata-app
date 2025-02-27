@extends('layouts.template')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filter Laporan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.filter') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dari_tanggal">Dari Tanggal</label>
                            <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal" value="{{ request('dari_tanggal') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sampai_tanggal">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="sampai_tanggal" name="sampai_tanggal" value="{{ request('sampai_tanggal') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select class="form-control" id="kategori_id" name="kategori_id">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kategori_rekening_id">Kategori Rekening</label>
                            <select class="form-control" id="kategori_rekening_id" name="kategori_rekening_id">
                                <option value="">Semua Kategori Rekening</option>
                                @foreach ($kategoriRekenings as $kategoriRekening)
                                    <option value="{{ $kategoriRekening->id }}" {{ request('kategori_rekening_id') == $kategoriRekening->id ? 'selected' : '' }}>{{ $kategoriRekening->nama_kategori_rekening }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mt-4">Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(isset($transaksis))
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Data Laporan Keuangan</h3>
        </div>
        <div class="card-body">
            <!-- Menampilkan data filter -->
            <dl class="row">
                <dt class="col-sm-4">Dari Tanggal</dt>
                <dd class="col-sm-8">{{ request('dari_tanggal') ?? '-' }}</dd>

                <dt class="col-sm-4">Sampai Tanggal</dt>
                <dd class="col-sm-8">{{ request('sampai_tanggal') ?? '-' }}</dd>

                <dt class="col-sm-4">Kategori</dt>
                <dd class="col-sm-8">{{ $kategoris->find(request('kategori_id'))->nama_kategori ?? 'Semua Kategori' }}</dd>

                <dt class="col-sm-4">Kategori Rekening</dt>
                <dd class="col-sm-8">{{ $kategoriRekenings->find(request('kategori_rekening_id'))->nama_kategori_rekening ?? 'Semua Kategori Rekening' }}</dd>
            </dl>

            <!-- Tombol Cetak PDF -->
            <button id="printButton" class="btn btn-success mb-3">Cetak PDF</button>

            <div class="table-responsive" id="printArea">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" rowspan="2">No</th>
                            <th class="text-center" rowspan="2">Tanggal</th>
                            <th class="text-center" rowspan="2">Kategori</th>
                            <th class="text-center" rowspan="2">Kategori Rekening</th>
                            <th class="text-center" rowspan="2">Keterangan</th>
                            <th class="text-center" colspan="2">Jenis</th>
                        </tr>
                        <tr>
                            <th class="text-center">Pemasukan</th>
                            <th class="text-center">Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPemasukan = 0;
                            $totalPengeluaran = 0;
                        @endphp
                        @foreach($transaksis as $transaksi)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $transaksi->tanggal }}</td>
                                <td class="text-center">{{ $transaksi->kategori->nama_kategori }}</td>
                                <td class="text-center">{{ $transaksi->kategoriRekening->nama_kategori_rekening }}</td>
                                <td class="text-center">{{ $transaksi->keterangan }}</td>
                                <td class="text-center">{{ number_format($transaksi->pemasukan, 0, ',', '.') }}</td>
                                <td class="text-center">{{ number_format($transaksi->pengeluaran, 0, ',', '.') }}</td>
                            @php
                                $totalPemasukan += $transaksi->pemasukan;
                                $totalPengeluaran += $transaksi->pengeluaran;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-right">TOTAL</th>
                            <th class="text-center">Rp. {{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                            <th class="text-center">Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-right">SALDO AKHIR</th>
                            <th colspan="2" class="text-right">Rp. {{ number_format( $saldoAkhir, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    document.getElementById('printButton').addEventListener('click', function() {
        // Menyimpan elemen-elemen yang tidak ingin dicetak
        const filterSection = document.querySelector('.card:first-child');
        const printButton = document.getElementById('printButton');

        // Menyembunyikan elemen-elemen yang tidak ingin dicetak
        filterSection.style.display = 'none';
        printButton.style.display = 'none';

        // Memicu fungsi cetak
        window.print();

        // Mengembalikan elemen-elemen yang disembunyikan
        filterSection.style.display = '';
        printButton.style.display = '';
    });
</script>
@endsection
