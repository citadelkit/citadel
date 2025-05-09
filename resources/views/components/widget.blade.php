<div style="{{ $style['colspan'] }} border-radius: .35rem; position:relative;" class="citadel-widget {{ $color }} overflow-hidden"
    config="{{ json_encode($config) }}" id="{{ $name }}">
    <div class="card {{ $theme[0] }}" id="background">
        <div class="card-body py-0" style="min-height: 130px">
            <header class="card-title font-medium-5 my-1 {{ $theme[1] }}"><strong>{{ $title }}</strong>
            </header>

            <div class="content">
                {!! $view !!}
            </div>
        </div>
    </div>
</div>
