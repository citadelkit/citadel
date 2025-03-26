<div class="accordion" id="accordionExample">
    @foreach ($schema as $key => $item)
                {{ $inject($item)->backbone() }}
    @endforeach
</div>