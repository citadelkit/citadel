<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $page_title }}</title>
    @include('citadel-template::dash.head')
</head>

<body class="bg-light">
    <div id="db-wrapper">
        <!-- navbar vertical -->
        {!! $sidebar !!}
        <!-- page content -->
        <div id="page-content">
            {!! $header !!}
            <!-- Container fluid -->
            <div class="container-fluid px-0">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
