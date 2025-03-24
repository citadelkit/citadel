<div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $name }}" aria-expanded="true" aria-controls="collapse-{{ $name }}">
        {{ $title }}
      </button>
    </h2>
        <div id="collapse-{{ $name }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            {!! $html !!}
            </div>
        </div>
</div>