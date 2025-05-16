<li class="dropdown ms-2">
    <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <div class="avatar avatar-md avatar-indicators avatar-online">
            <img alt="avatar" src="{{ $user['image'] }}" class="rounded-circle" />
        </div>
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
        <div class="px-4 pb-0 pt-2">
            <div class="lh-1">
                <h5 class="mb-1">{{ $user['name'] }}</h5>
            </div>
            <div class="dropdown-divider mt-3 mb-2"></div>
        </div>

        <ul class="list-unstyled">
            @if ($slot->hasActualContent())
                {{ $slot }}
            @else
                <x-header-nav-menu-item title="Sign Out" icon="power" href="/auth/logout" />
            @endif
            {{-- <x-header-nav-menu-item title="Edit Profile" icon="user"> --}}
            {{-- <li><a class="dropdown-item" href="#"><i class="me-2 icon-xxs" data-feather="activity"></i>Activity
                    Log</a></li>
            <li><a class="dropdown-item text-primary" href="#"><i class="me-2 icon-xxs text-primary"
                        data-feather="star"></i>Go Pro</a></li>
            <li><a class="dropdown-item" href="#"><i class="me-2 icon-xxs" data-feather="settings"></i>Account
                    Settings</a></li>
            <li><a class="dropdown-item" href="{{ url('/') }}"><i class="me-2 icon-xxs"
                        data-feather="power"></i>Sign Out</a></li> --}}
        </ul>
    </div>
</li>
