@extends('layouts.template')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">Data Transaksi</h4>
            <button class="btn btn-md btn-outline-primary float-right" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Transaksi
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-borderless table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Kategori Rekening</th>
                            <th>Keterangan</th>
                            <th colspan="2">Jenis</th>
                            <th>Opsi</th>
                        </tr>
                        <tr class="text-center">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($transaksis as $transaksi)
                        <tr class="text-center">
                            <td>{{$no++}}</td>
                            <td>{{$transaksi->tanggal}}</td>
                            <td>{{$transaksi->kategori->nama_kategori}}</td>
                            <td>{{$transaksi->kategoriRekening->nama_kategori_rekening}}</td>
                            <td>{{$transaksi->keterangan}}</td>
                            <td>
                                @if($transaksi->pemasukan)
                                    Rp. {{ number_format($transaksi->pemasukan, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($transaksi->pengeluaran)
                                    Rp. {{ number_format($transaksi->pengeluaran, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#edit{{$transaksi->id}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                                    <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="post" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                         <!-- Modal Edit -->
                         <div class="modal fade" id="edit{{$transaksi->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Transaksi</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" id="editForm{{$transaksi->id}}">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal</label>
                                                <input type="date" class="form-control" name="tanggal" value="{{ $transaksi->tanggal }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis">Jenis</label>
                                                <select name="jenis" class="form-control jenis-select" required>
                                                    <option value="pemasukan" {{ $transaksi->jenis == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                                    <option value="pengeluaran" {{ $transaksi->jenis == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori_id">Kategori</label>
                                                <select name="kategori_id" class="form-control" required>
                                                    @foreach ($kategoris as $kategori)
                                                        <option value="{{ $kategori->id }}" {{ $kategori->id == $transaksi->kategori_id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori_rekening_id">Kategori Rekening</label>
                                                <select name="kategori_rekening_id" class="form-control" required>
                                                    @foreach ($kategoriRekenings as $kategoriRekening)
                                                        <option value="{{ $kategoriRekening->id }}" {{ $kategoriRekening->id == $transaksi->kategori_rekening_id ? 'selected' : '' }}>{{ $kategoriRekening->nama_kategori_rekening }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nominal">Nominal</label>
                                                <input type="number" class="form-control" name="nominal" value="{{ $transaksi->pemasukan ?: $transaksi->pengeluaran }}" required placeholder="Masukkan nominal">
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea name="keterangan" class="form-control" placeholder="Masukkan keterangan">{{ $transaksi->keterangan }}</textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('transaksi.store') }}" method="POST" id="addForm">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select name="jenis" class="form-control" required>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori_id">Kategori</label>
                        <select name="kategori_id" class="form-control" required>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori_rekening_id">Kategori Rekening</label>
                        <select name="kategori_rekening_id" class="form-control" required>
                            @foreach ($kategoriRekenings as $kategoriRekening)
                                <option value="{{ $kategoriRekening->id }}">{{ $kategoriRekening->nama_kategori_rekening }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="number" class="form-control" name="nominal" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" placeholder="Masukkan keterangan (Opsional)"></textarea>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>


@endsection
