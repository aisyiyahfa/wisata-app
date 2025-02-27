@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Data Kategori Surat</h4>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-outline-primary px-4 shadow" style="border-radius: 25px;"
                    data-toggle="modal" data-target="#addKategoriModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                </button>
                <table id="example1" class="table table-borderless table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editKategoriModal{{ $item->id }}"><i class="fa fa-pencil-alt"
                                            aria-hidden="true"></i></button>
                                    <form action="{{ route('kategori-surat.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"
                                                aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit Kategori -->
                            <div class="modal fade" id="editKategoriModal{{ $item->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('kategori-surat.update', $item->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="nama" class="form-control"
                                                    value="{{ $item->nama }}" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('kategori-surat.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Kategori" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
