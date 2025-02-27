@extends('layouts.template')

@section('content')
    <x-breadcrumb
        :values="[__('menu.sekretaris.menu'), __('menu.sekretaris.incoming_letter')]">
        <a href="{{ route('sekretaris.incoming.create') }}" class="btn btn-primary">{{ __('menu.general.create') }}</a>
    </x-breadcrumb>

    @foreach($data as $letter)
        <x-letter-card
            :letter="$letter"
        />
    @endforeach

    {!! $data->appends(['search' => $search])->links() !!}
@endsection