{{--
<link rel="manifest" href="{{ asset('manifest.json') }}"> --}}
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
<link rel="icon" href="{{ asset('assets/img/favicon.png') }}">


<script src="{{ asset('v2/jquery-3.7.1/js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-i18next@1.2.1/jquery-i18next.min.js"
    integrity="sha256-Vo1wrHjny4hQDPA9SwBUpG/EBawhvUusdqRHb3Ia7x8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/i18next-xhr-backend@3.2.2/i18nextXHRBackend.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/i18next@23.15.1/i18next.min.js"></script>
<script src="{{ asset('v2/unison/js/unison.min.js') }}"></script>
<script src="{{ asset('v2/perfect-scrollbar/js/perfect-scrollbar.min.js') }}"></script>

{{-- Bootstrap 4.0.0 --}}
<script type="text/javascript" src="{{ asset('v2/jasny-bootstrap-4.0.0/js/jasny-bootstrap.min.js') }}"></script>

{{-- jQuery extension --}}
<script type="text/javascript" src="{{ asset('assets/plugins/autoNumeric/autoNumeric.js') }}"></script>
<script type="text/javascript" src="{{ asset('v2/loading-overlay-2.1.7/js/loading-overlay.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/moment/min/moment.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}">
</script>
<script type="text/javascript" src="{{ asset('v2/select2-4.0.13/dist/js/select2.full.min.js') }}"></script>

<link rel="stylesheet" href="{{ asset('assets/new/edittreetable/src/jquery.edittreetable.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('assets/css/chosen/chosen.min.css') }}"> --}}
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<script src="{{ asset('assets/plugins/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('assets/plugins/numeral/numeral.js') }}"></script>
<script src="{{ asset('assets/js/lodash.js') }}"></script>
<script src="{{ asset('assets/js/bootstraptoggle.js') }}"></script>
<script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-form/jquery.form.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-table/dist/bootstrap-table.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-table/dist/extensions/editable/bootstrap-table-editable.min.js') }}">
</script>
<script src="{{ asset('assets/plugins/bootstrap-table/dist/extensions/filter/bootstrap-table-filter.min.js') }}">
</script>
<script
    src="{{ asset('assets/plugins/bootstrap-table/dist/extensions/filter-control/bootstrap-table-filter-control.min.js') }}">
</script>
<script
    src="{{ asset('assets/plugins/bootstrap-table/dist/extensions/key-events/bootstrap-table-key-events.min.js') }}">
</script>
<script
    src="{{ asset('assets/plugins/bootstrap-table/dist/extensions/reorder-columns/bootstrap-table-reorder-columns.min.js') }}">
</script>
<script
    src="{{ asset('assets/plugins/bootstrap-table/dist/extensions/natural-sorting/bootstrap-table-natural-sorting.min.js') }}">
</script>
<script
    src="{{ asset('assets/plugins/bootstrap-table/dist/extensions/reorder-columns/bootstrap-table-reorder-columns.min.js') }}">
</script>
<script src="{{ asset('assets/plugins/bootstrap-table/dist/extensions/toolbar/bootstrap-table-toolbar.min.js') }}">
</script>
<script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('assets/js/inspinia.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('assets/app-assets/vendors/js/jquery.steps-1.1.0/jquery.steps.min.js') }}"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script src="{{ asset('assets/js/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/plugins/selectize.js/dist/js/selectize.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>


@if (true)
    <script type="module" src="http://localhost:5174/@@vite/client"></script>
    <script type="module" src="http://localhost:5174/resources/js/index.js"></script>
    <link rel="stylesheet" href="http://localhost:5174/resources/css/main.scss">
@else
    <link rel="stylesheet" href="{{ vitadel('resources/css/main.css') }}">
    <script src="{{ vitadel('resources/js/index.js') }}" defer></script>
@endif
