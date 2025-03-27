@extends('citadel-template::dash.layout')
@section('content')
    <div class="">
        <div style="{{ $style['columns'] }}" class="p-4">
            {!! $html !!}
        </div>
    </div>
@endsection
