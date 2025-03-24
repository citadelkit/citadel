@extends('citadel-template::core.template')
@section('content')
<div style="">
    <div class="gradient-wika px-4" style="{{$style['columns']}} margin-top: 3rem">
        {!! $html !!}
    </div>
</div>
@endsection
