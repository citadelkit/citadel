<div class="card" style="{{ $style['colspan'] }}">
    <div class="card-body {{ $direction['header_direction'] }} mb-3">
        <ul class="nav nav-pills gap-2 {{ $direction['nav_direction'] }}">
            @foreach ($schema as $key => $item)
                {{ $item->backboneLabel() }}
            @endforeach
        </ul>
        <hr>
        <div class="card-content">

            <div class="tab-content" id="{{ $name }}-content">
                @foreach ($schema as $key => $item)
                    {{ $inject($item)->backbone() }}
                @endforeach
            </div>
        </div>
    </div>

</div>
