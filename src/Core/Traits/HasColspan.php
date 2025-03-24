<?php

namespace Citadel\Core\Traits;

trait HasColspan {
    protected $colspan = 1;

    public function colspan($colspan = 2)
    {
        $this->colspan = $colspan;
        return $this;
    }

    public function getColspanClass()
    {
        return "grid-column: span $this->colspan/span $this->colspan;";
    }
}
