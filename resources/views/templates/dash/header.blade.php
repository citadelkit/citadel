<x-header-nav-container>
    <x-header-nav-toggle />
    <x-header-nav-search />
    <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
        <x-header-nav-notification :notifications="$notifications" />
        <x-header-nav-user :user="$user" />
    </ul>
</x-header-nav-container>
