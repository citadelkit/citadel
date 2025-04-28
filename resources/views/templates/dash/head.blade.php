<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<base href="{{ url('/') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}" />


<!-- Favicon icon-->
<link rel="shortcut icon" type="image/x-icon" href="@@webRoot/assets/images/favicon/favicon.ico">

<!-- Libs CSS -->


{{-- <link href="@@webRoot/node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="@@webRoot/node_modules/dropzone/dist/dropzone.css"  rel="stylesheet">
<link href="@@webRoot/node_modules/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
<link href="@@webRoot/node_modules/prismjs/themes/prism-okaidia.css" rel="stylesheet"> --}}








<!-- Theme CSS -->
<!-- build:css @@webRoot/assets/css/theme.min.css -->
{{-- <link rel="stylesheet" href="@@webRoot/assets/css/theme.css"> --}}
<!-- endbuild -->


@if (config('citadel.mode') == "development")
    <script type="module" src="http://localhost:5174/@@vite/client"></script>
    <script type="module" src="http://localhost:5174/resources/js/index.js"></script>
    <link rel="stylesheet" href="http://localhost:5174/resources/css/main.scss">
@elseif(config('citadel.mode') == "build")
    <link rel="stylesheet" href="{{ vitadel('resources/css/main.css') }}">
    <script src="{{ vitadel('resources/js/index.js') }}" defer></script>
@endif
