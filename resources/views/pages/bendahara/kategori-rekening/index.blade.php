@extends('layouts.template')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">Data Kategori Rekening</h4>
        </div>
        <div class="card-body">  
            <div class="d-flex align-items-center">  
                <button class="btn btn-md btn-outline-primary px-4 shadow" style="border-radius: 25px;" data-toggle="modal" data-target="#modal-default">  
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add  
                </button>  
            </div>              
            <div class="table-responsive">
                <table id="example1" class="table table-borderless table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Kategori Rekening</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($kategoriRekenings as $kategoriRekening)
                        <tr class="text-center">
                            <td>{{$no++}}</td>
                            <td>{{$kategoriRekening->nama_kategori_rekening}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#edit{{$kategoriRekening->id}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                                    <form action="{{route('kategori-rekening.destroy', $kategoriRekening->id)}}" method="post" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="edit{{$kategoriRekening->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Kategori Rekening</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('kategori-rekening.update', $kategoriRekening->id)}}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="nama_kategori_rekening">Nama Kategori Rekening</label>
                                                <input type="text" class="form-control" value="{{$kategoriRekening->nama_kategori_rekening}}" name="nama_kategori_rekening" id="nama_kategori_rekening" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
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
                <h4 class="modal-title">Add Kategori Rekening</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('kategori-rekening.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kategori_rekening">Nama Kategori Rekening</label>
                        <input type="text" class="form-control" name="nama_kategori_rekening" id="nama_kategori_rekening" required>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
