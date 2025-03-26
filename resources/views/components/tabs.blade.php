

<div class="card" style="{{ $style['colspan'] }}">
    <div class="card-header">
        <ul class="nav nav-pills gap-2">
            @foreach ($schema as $key => $item)
                {{ $item->backboneLabel() }}

            @endforeach
        </ul>
    </div>
    <div class="card-content">

        <div class="tab-content" id="{{$name}}-content">
            @foreach ($schema as $key => $item)
                {{ $inject($item)->backbone() }}
            @endforeach
        </div>
    </div>
</div>
