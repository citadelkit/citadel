<style>
    fieldset.informasi-user {
        border: 1px groove #949494 !important;
        padding: 0 1.4em 0.4em 1.4em !important;
        margin: 0 0 0 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }

    legend.e-user {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
    }

    legend {
        width: 40%;
    }

    .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24;
            margin: 0 3px;
            font-size: large;
            user-select: none;
            pointer-events: none;
        }

        .tooltip-inner {
      background-color: #ffffff;
      color: #333;
      padding: 10px;
      border-radius: 5px; 
      box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.2);

    }

    .tooltip-inner, .tooltip {
      opacity: 1 !important;
    }
</style>

<div class="modal fade" id="upld_UskepOnline" tabindex="-1" role="dialog" aria-labelledby="upld_UskepOnlineLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ url('uskep_online_sap/import_uskep') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih File Uskep</label>
                        <input type="file" name="fileUskep">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light header-navbar navbar-fixed hidden-print bg-white">
    <div class="container-fluid navbar-wrapper">
        <div class="navbar-header d-flex">
            <div class="navbar-toggle menu-toggle d-xl-none d-block float-left align-items-center justify-content-center"
                data-toggle="collapse"><i class="ft-menu font-medium-3"></i></div>
            <ul class="navbar-nav">
                <li class="nav-item mr-2 d-none d-lg-block">
                    <a class="nav-link apptogglefullscreen" id="navbar-fullscreen" href="javascript:;">
                        <i class="ft-maximize font-medium-3"></i>
                    </a>
                </li>
                <li>
                    <img src="{{ url('assets/img/Logo_BUMN_Untuk_Indonesia_2020.png') }}" width="150" />
                </li>
            </ul>
        </div>

        <div class="navbar-container">
            <div class="collapse navbar-collapse d-block" id="navbarSupportedContent">
                <ul class="navbar-nav mt-2">

                <li class="mr-2">

                <button type="button" class="btn" 
                data-bs-toggle="tooltip" 
                data-bs-placement="left" 
                data-bs-container="body" 
                data-html="true" 

                title="
                   <div class='tooltip-content black bg-white text-start'>
                   <h6><strong>Peringatan <i class='ft-info font-medium warning'></i></strong></h6> 
                   <p>
                       {{ __('message_release_notif') }}
                    </p>
            </div>
            " 
                readonly>
                    <i class="ft-info font-medium-5 warning"></i>
                </button>

                </li>

                    <li class="dropdown nav-item mr-2">
                        {{-- <a class="nav-link count-info dropdown-toggle user-dropdown d-flex align-items-end"
                            id="dropdownBasic2" href="javascript:;" data-toggle="dropdown">
                            <i class="ft-mail"></i>

                        </a> --}}
                        <div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0"
                            aria-labelledby="dropdownBasic2">

                            <a class="dropdown-item" href="log/readchat/">
                                <div class="d-flex align-items-center">
                                    <i class="ft-message-circle"></i>&nbsp;&nbsp;<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp; <small>...</small>
                                </div>
                            </a>

                            <a class="dropdown-item">
                                <div class="d-flex align-items-center">

                                </div>
                            </a>

                        </div>
                    </li>
                    <!--app -->
                    @if (auth()->user()->user_type == "internal" && auth()->user()->fullname != 'SUPERADMIN')
                    @php
                        $placements = auth()->user()->pluckPlacement();
                    @endphp
                    <li class="dropdown nav-item mr-1">
                        <a class="nav-link dropdown-toggle" id="dropdownBasicapp" href="javascript:;"
                            data-toggle="dropdown">
                            <i class="fab fa-arrow_drop_down" style="display: flex; align-items:center;">
                                {{ $placements[request('placement')] ?? $placements->first()}}
                                <span class="material-symbols-outlined">
                                    arrow_drop_down
                                    </span>
                            </i>
                        </a>
                        <div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0"
                            aria-labelledby="dropdownBasicapp" style="width: 345px;">
                                @foreach (auth()->user()->pluckPlacement() as $id => $name)
                                    <a href="{{ route('admin.switch_placement', $id) }}" class="nav-link hover px-2 {{ $id == request('placement') ? "active" : "" }}">{{$name}}</a>
                                @endforeach
                        </div>
                    </li>

                    <li class="dropdown nav-item mr-1">
                        <a class="nav-link dropdown-toggle" id="dropdownBasicapp" href="javascript:;"
                            data-toggle="dropdown">
                            <i class="" style="display: flex; align-items:center;">
                                App
                                <span class="material-symbols-outlined">
                                    arrow_drop_down
                                    </span>
                                </i>
                        </a>
                        <div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0"
                            aria-labelledby="dropdownBasicapp" style="width: 345px;">
                            {!! AppSSO() !!}
                        </div>
                    </li>
                    @endif

                    <!--- ============ New notif ================ -->
                    <li class="dropdown nav-item mr-1">
                        <a class="nav-link dropdown-toggle dropdown-notification" id="dropdownBasic1"
                            href="javascript:;" data-toggle="dropdown">
                            <i class="ft-bell font-medium-1"></i>
                            <span class="notification badge badge-pill badge-danger"
                                id="notificationUnreadTotal"></span>
                        </a>
                        <ul
                            class="notification-dropdown dropdown-menu dropdown-menu-media dropdown-menu-right overflow-hidden">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header d-flex justify-content-between white bg-info">
                                    <div class="d-flex"><i
                                            class="ft-bell font-medium-3 d-flex align-items-center mr-2"></i><span
                                            class="noti-title"></span>
                                        {{ __('Notification') }}
                                    </div>

                                </div>
                            </li>
                            @if (Auth::user() && Auth::user()->nip)
                                <li class="scrollable-container" id="notificationListContainer"
                                    data-src="{{ route('notification.info', Auth::user()->nip ?? Auth::user()->email ) }}">
                                    {{-- @foreach ([1, 2] as $x)
                                        {!! view('components.notifications.item')->render() !!}
                                    @endforeach --}}
                                </li>
                            @else
                            @endif

                            <li class="dropdown-menu-footer">
                                <div class="d-flex flex-row pt-2">
                                    <a href="{{ route('admin.notification.index') }}" class="col-6">
                                        <div class="noti-footer text-center cursor-pointer info text-bold-400">
                                            Read All Notifications {{ $total_notification ?? '' }}</div>
                                    </a>

                                    <a href="javascript:void(0)" onclick="requestNotificationPermission()" class="col-6">
                                        <div class="noti-footer text-center cursor-pointer info text-bold-400">
                                            Request Permission</div>
                                    </a>
                                </div>

                            </li>


                            <div class="d-flex justify-content-between cursor-pointer read-notification">
                                <div class="media d-flex align-items-center">
                                    <div class="media-body">
                                        <h6 class="m-0"><small
                                                class="grey lighten-1 font-italic text-center"></small>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                        </ul>
                    </li>

                    {{-- <li class="dropdown nav-item mr-1" x-data="{ open: false }">
                        @if ($user->user_type !== 'vendor')
                            <a class="nav-link count-info dropdown-toggle user-dropdown d-flex align-items-end"
                                id="dropdownPosition" data-toggle="dropdown" @click.prevent="open=!open">
                                <div class="user d-md-flex d-none"><span class="text-right"><i
                                            class="ft-users mr-1"></i>
                                        Ganti Posisi </span></div>
                            </a>
                        @endif

                        <div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0"
                            aria-labelledby="dropdownPosition" :class="open ? 'show' : ''">
                            @if (isset($user))
                                @foreach ($user->positions as $position)
                                    <a class="dropdown-item"
                                        href="{{ url()->route('admin.change_role_user', [$position->id]) }}">
                                        <div class="d-flex align-items-center"><i
                                                class="ft-chevron-right mr-1"></i><span>{{ $position->nama_posisi . ' (' . $position->kode_posisi . ')' }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </li> --}}

                    <li class="dropdown nav-item mr-1">
                        <a class="nav-link dropdown-toggle" id="dropdownBasic2" href="javascript:;"
                            data-toggle="dropdown">
                            {{-- <i class="ft-menu mr-1"></i> --}}
                            <div class="container-avatar d-inline"><img src="{{ optional($user)->foto_url }}" class="rounded-circle object-cover border" style="width: 35px; height: 35px"></div>
                        </a>
                        <div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0"
                            aria-labelledby="dropdownBasic2" style="width: 345px;">
                            <a class="nav-link" href="#">
                                <div class="user d-md-flex d-none">
                                    <span class="text-right">
                                        <fieldset class="informasi-user">
                                            <legend class="scheduler-border">Informasi</legend>
                                            <div class="control-group">
                                            </div>
                                        </fieldset>
                                    </span>
                                </div>
                            </a>
                            {{-- <a class="nav-link" href="{{ route('admin.user_dashboard.index') }}">
                                <div class="user d-md-flex d-none">
                                    <span class="text-right">
                                        <i class="ft-lock mr-1"></i> Ubah Password
                                    </span>
                                </div>
                            </a> --}}
                            <a class="nav-link"
                                href="{{ optional($user)->user_type != 'vendor' ? url()->route('admin.logout') : route('vendor.logout') }}"
                                id="logout">
                                <div class="user d-md-flex d-none">
                                    <span class="text-right">
                                        <i class="ft-log-out mr-1"></i> Logout
                                    </span>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script type="text/javascript">
    $(function() {
        $('a#logout').click(function() {
            if (confirm('Apakah anda yakin ingin logout?')) {
                return true;
            }

            return false;
        });
        let $notificationListContainer = $("#notificationListContainer")
        let $notificationUnreadTotal = $("#notificationUnreadTotal")
        let notificationUrl = $notificationListContainer.data('src')
        async function fetchNotification() {
            // if (document.visibilityState === 'visible' && document.readyState === 'complete')
                $.get(notificationUrl).done(function(response) {
                    $notificationListContainer.html(response.result.html)
                    $notificationUnreadTotal.html(response.result.unread_total || "")
                })
        }
        fetchNotification()

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
              return new bootstrap.Tooltip(tooltipTriggerEl)
            })

    });
</script>
