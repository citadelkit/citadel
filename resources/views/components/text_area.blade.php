<div class="form-group" style="{{ $style['colspan'] }}">
    <label for="input-{{ $name }}" class="control-label ">{{ $title }}</label>
    <div class="input-group">
            <input id="{{ $name }}" name="{{ $name }}" type="text" class="form-control" placeholder="{{ $placeholder }}"  value="{!! $value !!}" >
    </div>
    <small class="text-danger mt-2"></small>
</div>
