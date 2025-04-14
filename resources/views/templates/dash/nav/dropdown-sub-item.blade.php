<li class="nav-item">
    <a class="nav-link {{ request()->is('pages/profile') ? 'active' : '' }}" href="{{ route('pages.profile') }}">
        Profile
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('pages/settings') ? 'active' : '' }}" href="{{ route('pages.settings') }}">
        Settings
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('pages/billing') ? 'active' : '' }}" href="{{ route('pages.billing') }}">
        Billing
    </a>
</li>