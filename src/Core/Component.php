<?php

namespace Citadel\Core;

use Citadel\Core\Contracts\Backbone;
use Citadel\Core\Contracts\Reactive;
use Citadel\Core\Traits\CommonCitadelElement;
use Citadel\Core\Traits\HasColspan;
use Citadel\Core\Traits\HasData;
use Citadel\Core\Traits\Makeable;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component as LaravelBladeComponent;

class Component extends LaravelBladeComponent implements Backbone, Reactive
{
    use CommonCitadelElement, HasData, Makeable, HasColspan;
    protected $lifecycle, $parent;
    protected $pass_data = [];
    protected $identifier;

    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    public function setLifecycle($lifecycle)
    {
        $this->lifecycle = $lifecycle;
        return $this;
    }

    public function passData($pass_data)
    {
        $this->pass_data = $pass_data;
        return $this;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function renderReactive($component_name)
    {
        if ($component_name == $this->name) return $this;
        return null;
    }

    public function reactive()
    {
        return [];
    }

    public function backbone()
    {
        return view('citadel-template::core.component', $this->data());
    }

    public function parser() {}

    final public function __toString()
    {
        return $this->backbone();
    }

    public function render() {
        return $this->backbone();
    }
}
