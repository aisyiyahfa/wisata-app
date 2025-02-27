@extends('layouts.template')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">Data Kategori</h4>
        </div>
        <div class="card-body">  
            @if(in_array(Auth::user()->role_id, [1,3,4]))
            <div class="d-flex align-items-center">  
                <!-- Tombol Add -->  
                <button class="btn btn-md btn-outline-primary px-4 shadow" style="border-radius: 25px;" data-toggle="modal" data-target="#modal-default">  
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add  
                </button>  
                @endif
            </div>              
            <div class="table-responsive">
                <table id="example1" class="table table-borderless table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Kategori</th>
                            @if(in_array(Auth::user()->role_id, [1,3,4]))
                            <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($kategoris as $kategori)
                        <tr class="text-center">
                            <td>{{$no++}}</td>
                            <td>{{$kategori->nama_kategori}}</td>
                            <td>
                                @if(in_array(Auth::user()->role_id, [1,3,4]))
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#edit{{$kategori->id}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                                    <form action="{{route('kategoris.destroy', $kategori->id)}}" method="post" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="edit{{$kategori->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Kategori</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <form action="{{route('kategoris.update', $kategori->id)}}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="nama_kategori">Nama Kategori</label>
                                                <input type="text" class="form-control" value="{{$kategori->nama_kategori}}" name="nama_kategori" id="nama_kategori" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
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
                <h4 class="modal-title">Add Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{route('kategoris.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
