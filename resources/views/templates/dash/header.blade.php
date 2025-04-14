<x-header-nav-container>
    <x-header-nav-toggle />
    <x-header-nav-search />
    <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
        <x-header-nav-notification :notifications="[
            ['name' => 'Rishi Chopra', 'message' => 'Mauris blandit erat id nunc blandit...'],
            ['name' => 'Neha Kannned', 'message' => 'Proin at elit vel est...'],
            ['name' => 'Nirmala Chauhan', 'message' => 'Morbi maximus urna...'],
            ['name' => 'Sina Ray', 'message' => 'Sed aliquam augue sit amet...'],
        ]" />

        <x-header-nav-user :user="['name' => 'John E. Grainger']" />
    </ul>
</x-header-nav-container>
