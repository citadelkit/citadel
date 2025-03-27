<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @if (isset($page_info))
        <title>{{ $page_info['site_name'] }} - {{ $page_info['title'] }}</title>
    @else
        <title>
            @yield('title') - @yield('code')
        </title>
    @endif

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <base href="{{ url('/') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @include('citadel-template::core.head')
</head>

<body class="vertical-layout vertical-menu 2-columns navbar-sticky nav-collapsed" data-menu="vertical-menu" data-col="2-columns"
    x-data="{ sidebarOpen: false }" :class="sidebarOpen ? '' : 'nav-collapsed'">
    @if (Auth::user())
        @include('citadel-template::core.header')
    @endif
    <div class="wrapper">
        @if (Auth::user())
        @include('citadel-template::core.sidebar')
        @endif
        <div class="main-panel mb-4">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
                @yield('content')
            </div>
        </div>
        @include('citadel-template::core.footer')
    </div>

    @stack('body')
    @stack('modal')

    <!-- SweetAlert2 JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script> --}}

    <!-- LoadingOverylay -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
 --}}

    {{-- <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script> --}}

    {{-- <script type="text/javascript" src="assets/js/bottom.js"></script> --}}

    {{-- <script type="text/javascript" src="{{ asset('assets/app-assets/js/core/app-menu.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/app-assets/js/toastr/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/app-assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/app-assets/js/scroll-top.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/app-assets/js/components-modal.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/app-assets/vendors/js/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/app-assets/js/components-popover.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/app-assets/js/jquery.mask.min.js') }}"></script> --}}

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}
    {{-- @vite(['resources/js/simplebar.js', 'resources/js/app.js',]) --}}

</body>

</html>
