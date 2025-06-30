<div class="form-group" style="{{ $style['colspan'] }}" {{ $hidden ? 'hidden' : '' }} id="form-group-{{$name }}">
    {{-- {{ in_array('required', $rule) ? 'required' : '' }} --}}
    <label for="input-{{ $name }}">{{ $title }}</label>
    <div class="px-3">
        <div class="filepond" name="{{ $name }}" data-server="{{ json_encode($server) }}"
            data-files="{{ json_encode($files) }}" data-config="{{ json_encode($config) }}"></div>
        <span class="text-primary">{{ !empty($config['accepted_file_types']) ?  "Tipe File ({$file_labels})" : ' ' }}   {{ 'maks : ' . $config['max_size'] }}</span>
    </div>
</div>
