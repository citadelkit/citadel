<div class="modal-container">
    <div class="modal fade" tabindex="-1" id="{{ $name }}" config="{{ json_encode($config) }}"
        aria-labelledby="modal {{ $title }}"
        data-bs-scroll="{{ json_encode($body_scroll) }}"
        data-bs-backdrop="{{ json_encode($backdrop)}}"
        style="--bs-modal-width: {{ $width }};">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-{{$title}}">{{ $title }}</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    {!! $html !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>