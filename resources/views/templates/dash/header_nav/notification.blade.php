<li class="dropdown stopevent">
    <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="#" role="button"
        id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icon-xs" data-feather="bell"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification">
        <div>
            <div class="border-bottom px-3 pt-2 pb-3 d-flex justify-content-between align-items-center">
                <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                <a href="#" class="text-muted">
                    <i class="me-1 icon-xxs" data-feather="settings"></i>
                </a>
            </div>

            <ul class="list-group list-group-flush notification-list-scroll">
                @foreach ($notifications as $notification)
                    <li class="list-group-item {{ $loop->first ? 'bg-light' : '' }}">
                        <a href="#" class="text-muted">
                            <h5 class="mb-1">{{ $notification['name'] }}</h5>
                            <p class="mb-0">{{ $notification['message'] }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="border-top px-3 py-2 text-center">
                <a href="#" class="text-inherit fw-semi-bold">View all Notifications</a>
            </div>
        </div>
    </div>
</li>
