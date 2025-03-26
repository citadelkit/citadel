<div id="{{$name}}" class="bg-breadcrumb mt-3 mb-2 pb-2" style="{{$style['colspan']}}">
    <div class="mx-4 mt-4 mb-2">
        <div class="h4 text-white">
            <strong >{!! $title !!}</strong>
        </div>
    </div>
    <div class="position-relative" style="{{$style['columns']}} z-index: 2;">
        {!! $html !!}
    </div>
    {{-- <div class="col-5"> --}}
        <div class="illust d-flex justify-content-end" style="z-index: 1">
            <img src="{{ asset('/img/wika_employee.png') }}" alt="WIKA Logo"
                style="width: 160px;" />
        </div>
    {{-- </div> --}}
</div>
