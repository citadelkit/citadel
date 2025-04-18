@if ($dropdown)
    <div id="{{ $name }}" class="btn-group" role="group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            @if (!$no_label)
                <i class="{{ $icon }}"></i>
                <label for="">{{ $title }}</label>
            @endif
        </button>
        <ul class="dropdown-menu">
            {!! $html !!}
        </ul>
    </div>
@else
    <div id="{{ $name }}" class="btn-group" role="group">
        {!! $html !!}
    </div>
@endif
