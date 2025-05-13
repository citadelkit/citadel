@if($slot->hasActualContent())
    <li class="nav-item">
        <a class="nav-link has-arrow {{ request()->is('pages/*') ? 'show' : 'collapsed' }}" href="#!"
            data-bs-toggle="collapse" data-bs-target="#nav-{{ strSnake($title) }}" aria-expanded="false"
            aria-controls="navPages">
            {!! $icon !!} {{ $title }}
        </a>
        <div id="nav-{{ strSnake($title) }}" class="collapse {{ request()->is('pages/*') ? 'show' : '' }}"
            data-bs-parent="#{{ strSnake($parent) }}">
            <ul class="nav flex-column">
                {{ $slot }}
            </ul>
        </div>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin.tender.index') ? 'active' : '' }}"
            href="{{ $href }}" target={{ $target }}>
            {!! $icon !!} {{ $title }}
        </a>
    </li>
@endif
