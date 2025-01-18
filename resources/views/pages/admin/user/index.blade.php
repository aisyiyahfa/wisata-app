@extends('layouts.template')


@section('title')
User
@endsection
@section('sub-title')
User Data
@endsection


@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">Data User</h4>
        </div>
        <div class="card-body">
            <a href="{{route('user.create')}}" class="btn btn-outline-primary px-4 shadow" style="border-radius: 25px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</a>
            <div class="table-responsive">
                <table id="example1" class="table table-borderless table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($user as $item )
                        <tr class="text-center">
                            <td>{{$no++}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->role->nama_roles}}</td>
                            <td>{{ $item->jabatan ? $item->jabatan->nama_jabatan : 'Tidak ada jabatan' }}</td>  
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('user.edit', $item->id)}}" class="btn btn-sm btn-warning mr-1"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                                    <form action="{{route('user.destroy', $item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </div>
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
