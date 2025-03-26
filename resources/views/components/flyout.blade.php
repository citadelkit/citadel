<div class="flyout-container">
    <div class="offcanvas offcanvas-end flyout" tabindex="-1" id="{{ $name }}" config="{{ json_encode($config) }}"
        aria-labelledby="flyout {{ $title }}"
        data-bs-scroll="{{ json_encode($body_scroll) }}"
        data-bs-backdrop="{{ json_encode($backdrop)}}"
        style="--bs-offcanvas-width: {{ $width }};">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">{{ $title }}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="">
            {!! $html !!}
        </div>
    </div>

</div>
