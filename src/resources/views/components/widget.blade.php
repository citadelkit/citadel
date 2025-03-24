<div style="{{ $style['colspan'] }} border-radius: .35rem;" class="citadel-widget {{ $color }} overflow-hidden" config="{{ json_encode($config) }}" id="{{ $name }}">
    <div class="card {{ $theme[0] }}" id="background">
        <div class="card-content pb-3" style="min-height: 130px">
            <div class="card-body py-0">
                <div class="media pb-2">
                    <div class="media-body text-left">
                        <header class="font-medium-5 my-1 h4 {{$theme[1]}}"><strong>{{ $title }}</strong></header>
                        {{-- <br>
                        <span id="description">{{ $description }}</span> --}}
                    </div>
                    {{-- <div class="media-right white text-right">
                        <x-material-icon icon="{{ $icon }}" />
                    </div> --}}
                </div>

                <div class="content">
                    {!! $view !!}
                </div>
            </div>
        </div>
    </div>
</div>
