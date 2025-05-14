<div class="form-group" style="{{ $style['colspan'] }}">
    <label for="{{ $name }}" class="control-label ">{{ $title }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}" type="text" class="form-control" placeholder="{{ $placeholder }}"  rows="{{ $rows }}">{{ $value }}</textarea>
    <div class="error">
        <span class="text-danger"></span>
    </div>
</div>