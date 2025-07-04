<nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        {{-- <a class="navbar-brand text-center" href="{{ url('/') }}"> --}}
           <span class="navbar-brand text-center"> {{ $brand }} </span>
            {{-- <img src="{{ asset('assets/images/brand/logo/logo.svg') }}" alt="Logo" /> --}}
        {{-- </a> --}}
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            {{ $content }}
        </ul>
    </div>
</nav>