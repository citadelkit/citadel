@extends('citadel-template::core.template')
@section('content')
<div style="">
    <div class="gradient-wika" style="padding-bottom: 8.5rem !important; padding-top: 3rem !important">
    </div>
    <div style="{{$style['columns']}} margin-top: -9rem !important" class="px-4">
        {!! $html !!}
    </div>
</div>
@endsection