<div id="{{$name}}" class="card {{$style['class']}}" style="{{$style['colspan']}}">
    @if(!$no_header)
    <div class="mx-4 mt-4 mb-2">
        <div class="h5 ">
            <strong >{{$title}}</strong>
        </div>
    </div>
    <hr>
    @endif
    <div class="position-relative" style="{{$style['columns']}} {{$style['align']}} z-index: 2;">
        {!! $html !!}
    </div>
</div>
