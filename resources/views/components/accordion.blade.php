<div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button {{ $active == true ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $name }}" aria-expanded="{{ $active == true ? 'true' : 'false' }}" aria-controls="collapse-{{ $name }}">
        {{ $title }}
      </button>
    </h2>
        <div id="collapse-{{ $name }}" class="accordion-collapse collapse  {{ $active == true ? 'show' : '' }}" >
            <div class="accordion-body">
            {!! $html !!}
            </div>
        </div>
</div>