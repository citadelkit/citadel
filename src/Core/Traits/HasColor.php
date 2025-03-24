<?php

namespace Citadel\Core\Traits;

trait HasColor {
    protected $color = "primary";

    public function color($color)
    {
        $this->color = "$color";
        return $this;
    }

}
