<div class="form-group" style="{{ $style['colspan'] }}">
    <label for="#{{ $name }}">{{ $title }}</label>
    <input type="{{ $type }}" class="form-control" id="{{ $name }}" name="{{ $name }}"
        placeholder="{{ $placeholder }}" value="{{ $value }}">
    <div class="error">
        <span class="text-danger"></span>
    </div>
</div>
