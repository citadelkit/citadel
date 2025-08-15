<form id="{{$name}}" class="form-group citadel-form {{ $style['class'] }}" style="{{ $style['colspan'] }} {{ $style['custom'] }}" data-before-submit='@json($before_submit ?? [])'>
    <div class="" style="{{ $style['columns'] }}">
        {!! $html !!}
    </div>
</form>
