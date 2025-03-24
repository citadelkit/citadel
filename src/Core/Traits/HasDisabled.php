<?php

namespace Citadel\Core\Traits;

trait HasDisabled
{
    protected $disabled = false;

    public function disabled($disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    public function getDisabled()
    {
        return is_callable($this->disabled)
            ? $this->callCallable($this->disabled)
            : $this->disabled;
    }
}
