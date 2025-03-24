<?php

namespace Citadel\Core\Traits;

trait HasIcon
{
    protected $icon = "";

    public function icon($icon = "")
    {
        $this->icon = $icon;
        return $this;
    }
}
