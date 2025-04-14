<li class="nav-item">
    <a class="nav-link has-arrow {{ request()->is('pages/*') ? 'show' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navPages" aria-expanded="false" aria-controls="navPages">
        <i data-feather="layers" class="nav-icon icon-xs me-2"></i> Pages
    </a>
    <div id="navPages" class="collapse {{ request()->is('pages/*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
        <ul class="nav flex-column">
            @foreach ($pages as $page)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pages/'.$page['slug']) ? 'active' : '' }}" href="{{ route('pages.show', $page['slug']) }}">
                        {{ $page['title'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</li>