<div class="form-group" style="{{ $style['colspan'] }}">
    <label for="#{{ $name }}">{{ $title }}</label>
    <select class="form-control citadel-select" id="{{ $identifier }}" name="{{ $name }}"
        config="{{ json_encode($definition) }}">
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
    <div class="error">
        <span class="text-danger"></span>
    </div>
</div>
