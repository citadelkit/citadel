<x-nav-container>
    @slot('brand')
        {!! $brand !!}
    @endslot
    @slot('content')
        <x-nav-menu-item title="Home" href="/" icon="home" />
    @endslot
</x-nav-container>
