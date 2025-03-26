@if ($is_html)
    <div id="{{ $name }}" style="{{ $style['colspan'] }}">{!! $text !!}</div>
@else
    <div style="{{ $style['colspan'] }}" class="mx-4 mb-2 {{ $style['class'] }}">
        <span>{{ $text }}</span>
    </div>
@endif
