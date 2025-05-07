@if (isset($fluid) && $fluid)
    <div class="header {{ $classList ?? '' }}">
        <nav class="navbar-classic navbar navbar-expand-lg">
            <div class="container-fluid px-0" style="max-width: 80%">
                {{ $slot }}
            </div>
        </nav>
    </div>
@else
    <div class="header {{ $classList ?? '' }}">
        <nav class="navbar-classic navbar navbar-expand-lg">
            {{ $slot }}
        </nav>
    </div>
@endif
