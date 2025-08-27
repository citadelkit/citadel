@props(['title', 'href' => null, 'icon' => null, 'parent' => null, 'target' => null])

@php
    // Child item active: exact match
    $isActive = $href && request()->is(ltrim($href, '/'));

    // Parent active: one of its children matches current URL
    $isParentActive = false;
    if ($slot->hasActualContent()) {
        // crude but works: search current path inside rendered children HTML
        $isParentActive = Str::contains($slot, request()->path());
    }
@endphp

@if($slot->hasActualContent())
    <li class="nav-item">
        <a class="nav-link has-arrow {{ $isActive ? '' : 'collapsed' }}" href="#!"
            data-bs-toggle="collapse" 
            data-bs-target="#nav-{{ strSnake($title) }}" 
            aria-expanded="{{ $isParentActive ? 'true' : 'false' }}"
            aria-controls="navPages">
            {{-- {!! $icon !!} {{ $title }} --}}
             <span class="mb-1">{!! $icon !!}</span>
            <span class="small text-wrap">{{ $title }}</span>
        </a>
        <div id="nav-{{ strSnake($title) }}" 
            class="collapse {{ $isParentActive ? 'show' : '' }}"
            data-bs-parent="#{{ strSnake($parent) }}">
            <ul class="nav flex-column">
                {{ $slot }}
            </ul>
        </div>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link {{ $isActive ? 'active' : '' }}"
            href="{{ $href }}"  target={{ $target }}>
            {{-- {!! $icon !!} {{ $title }} --}}
             <span class="mb-1">{!! $icon !!}</span>
            <span class="small text-wrap">{{ $title }}</span>
        </a>
    </li>
@endif
