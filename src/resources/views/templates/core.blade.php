@extends('citadel-template::core.template')
@section('content')
    <div class="">
        <div style="{{ $style['columns'] }}" class="p-4">
            {!! $html !!}
        </div>
    </div>
@endsection
