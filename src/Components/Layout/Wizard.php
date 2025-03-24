<?php

namespace Citadel\Components\Layout;

use Citadel\Core\Component;
use Citadel\Core\Wrapper;

class Wizard extends Wrapper
{
    protected $steps = [];

    public function step(Component $step)
    {
        $this->steps[] = $step;
        return $this;
    }
}
