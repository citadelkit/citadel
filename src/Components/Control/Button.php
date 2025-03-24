<?php

namespace Citadel\Components\Control;

use Citadel\Components\Layout\ActionGroup;
use Citadel\Components\Support\Icon;
use Citadel\Core\Component;
use Citadel\Core\Traits\HasColor;
use Citadel\Core\Traits\HasURL;

class Button extends Component
{
    use HasURL, HasColor;
    protected $attr = "";
    private $on_click;
    protected $disabled;
    protected $icon;
    protected $target;

    public function icon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public function onClick($event) {
        $this->on_click = $event;
        return $this;
    }

    public function disabled($disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    public function getClass()
    {
        if($this->isDropdown()) {
            return "text-$this->color citadel-button text-nowrap";
        }
        return "btn btn-$this->color nav-$this->color citadel-button text-nowrap";
    }

    public function attr($attr)
    {
        $this->attr = $attr;
        return $this;
    }

    public function getAttr()
    {
        return $this->attr;
    }

    public function getUrl()
    {
        if(is_callable($this->url)) {
            return $this->callCallable($this->url, ...$this->pass_data);
        }
        return $this->url;
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'url' => $this->getUrl(),
            'icon' => $this->icon ? Icon::render($this->icon) : "",
            'style' => [
                'colspan' => $this->getColspanClass(),
                'class' => $this->getClass(),
                'style' => ""
            ],
            'attr' => $this->getAttr(),
            'is_group_item' => $this->isGroupItem(),
            'is_dropdown' => $this->isDropdown(),
            'disabled' => is_callable($this->disabled)
                ? $this->callCallable($this->disabled, ...$this->pass_data)
                : $this->disabled,
            'on_click' => $this->getOnClick(),
            'target' => $this->target
        ];
    }

    public function getOnClick()
    {
        return is_callable($this->on_click)
                ? $this->callCallable($this->on_click, ...$this->pass_data)
                : $this->on_click;
    }

    public function isGroupItem()
    {
        return $this->parent instanceof ActionGroup;
    }

    public function isDropdown()
    {
        if($this->parent instanceof ActionGroup) {
            return $this->parent->isDropdown();
        }
        return false;
    }

    public function target($target)
    {
        $this->target = $target;
        return $this;
    }

    public function backbone()
    {
        $result = view("citadel-component::button", $this->data());
        // if($this->name == "propose_pola_belanja") {
        //     dd($this->data(), $result->render());
        // }
        return $result;
    }
}
