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

    public $trigger;
    public $trigger_args;


    public function flyout($flyout_name, array $args = [])
    {
        $this->trigger = "flyout";
        $this->target = $flyout_name;
        $this->trigger_args = $args;
        return $this;
    }

    public function modal($modal_name, array $args = [])
    {
        $this->trigger = "modal";
        $this->target = $modal_name;
        $this->trigger_args = $args;
        return $this;
    }

    public function getTriggerArgs(...$args)
    {
        return collect($this->trigger_args)->map(function ($trigger_arg) use ($args) {
            if (is_callable($trigger_arg)) return call_user_func_array($trigger_arg, $args);
            return $trigger_arg;
        });
    }

    public function icon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public function onClick($event)
    {
        $this->on_click = $event;
        return $this;
    }

    public function disabled($disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    public function getTriggerType()
    {
        return match ($this->trigger) {
            'flyout' => 'button-flyout',
            'modal' => 'button-modal',
            default => 'button'
        };
    }

    public function getClass()
    {
        $trigger = $this->getTriggerType();
        if ($this->isDropdown()) {
            return "text-$this->color citadel-$trigger text-nowrap";
        }
        return "btn btn-$this->color nav-$this->color citadel-$trigger text-nowrap";
    }

    public function attr($attr)
    {
        $this->attr = $attr;
        return $this;
    }

    public function getAttr()
    {
        return match ($this->trigger) {
            'flyout' => "data-bs-backdrop=false data-bs-toggle=offcanvas " . $this->attr,
            'modal' => "data-bs-backdrop=false data-bs-toggle=modal " . $this->attr,
            default => $this->attr
        };
    }

    public function getUrl()
    {
        return match (true) {
            $this->trigger === 'flyout', 
            $this->trigger === 'modal' => "#".$this->target,
            is_callable($this->url) => $this->callCallable($this->url, ...$this->pass_data),
            default => $this->url
        };
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
            'target' => $this->target,
        ];
    }

    public function getOnClick()
    {
        if ($this->getTriggerType() == "button") {
            return is_callable($this->on_click)
                ? $this->callCallable($this->on_click, ...$this->pass_data)
                : $this->on_click;
        }
        return $this->getTriggerArgs(...$this->pass_data);
    }

    public function isGroupItem()
    {
        return $this->parent instanceof ActionGroup;
    }

    public function isDropdown()
    {
        if ($this->parent instanceof ActionGroup) {
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
