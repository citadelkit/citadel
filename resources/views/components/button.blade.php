@if ($is_group_item && !$is_dropdown)
    <a id="{{ $name }}" href="{{ $url }}" class="{{ $style['class'] }}" style="display: block;"
        {{ $attr }} {{ $target ? "target=$target" : '' }} @if ($disabled) disabled @endif
        data-ct-onclick='{{ json_encode($on_click) }}'>{!! $icon !!}{{ $title }}</a>
@elseif($is_dropdown)
    <li>
        <a id="{{ $name }}" href="{{ $url }}" class="dropdown-item {{ $style['class'] }}"
            style="display: block;" {{ $attr }} {{ $target ? "target=$target" : '' }}
            @if ($disabled) disabled @endif
            data-ct-onclick='{{ json_encode($on_click) }}'>{!! $icon !!}{{ $title }}</a>
    </li>
@else
    <a id="{{ $name }}" style="{{ $style['colspan'] }}" href="{{ $url }}"
        class="{{ $style['class'] }}" style="display: block;" {{ $attr }}
        {{ $target ? "target=$target" : '' }} @if ($disabled) disabled @endif
        data-ct-onclick='{{ json_encode($on_click) }}'>{!! $icon !!}{{ $title }}</a>
@endif
