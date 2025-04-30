@extends('citadel-template::dash.base')
@section('content')
    <div class="{{ $style['class'] }}" style="{{ $style['columns'] }}">
        {!! $html !!}
    </div>
@endsection
