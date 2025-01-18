@extends('layouts.template')


@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">Data Donasi</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-borderless table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Pengunjung</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donasi as $item )
                        <tr class="text-center">
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->nominal}}</td>
                            <td>{{$item->tanggal}}</td>
                            <td>{{$item->status}}</td>
                            <td>
                                <div class="btn-group ">
                                    <a href="" class="btn btn-md btn-warning"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    <form action="{{route('donasi.destroy', $item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>
                                </form>
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
