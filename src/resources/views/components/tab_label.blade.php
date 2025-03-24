
<li class="nav-item">
    <a class="nav-link {{ $active ? "active" : "" }}" aria-current="page" id="tab-label-{{ $name }}" data-toggle="tab"
        data-target="#tab-content-{{ $name }}" type="button"
        href="#tab-content-{{ $name }}"
        @if($disabled) disabled @endif
        >{{ $title }}</a>
</li>
