<?php

namespace Citadel\Components;

use Citadel\Core\Component;
use Illuminate\View\View;

class Widget extends Component {
    protected $template = "citadel-component::widget";
    protected $theme = "default";
    protected $reactive = null;
    protected string|null $color = null;
    /**
     * View to put inside widget. Can be reactive;
     */
    protected $view;

    protected function themeResolver()
    {
        return match($this->theme) {
            'color' => [
                'bg-transparent text-white', 'text-white'
            ],
            default => [
                'bg-white text-dark', 'text-dark'
            ]
        };
    }

    public function theme($theme)
    {
        $this->theme = $theme;
        return $this;
    }

    public function view($view, $data = [], $mergeData = [])
    {
        $this->view = view($view, $data, $mergeData);
        return $this;
    }

    public function icon()
    {
        return $this;
    }

    public function color($color)
    {
        $this->theme = "color";
        $this->color = $color;
        return $this;
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'color' => $this->color,
            'icon' => 'x',
            'source' => '',
            'description' => 'Fetcing Data, Please Wait...',
            'config' => [
                'reactive' => is_callable($this->reactive),
            ],
            'theme' => $this->themeResolver(),
            'getUrl' => fn() => null,
            'onClick' => false,
            'is_interactive' => true,
            'target' => true,
            'style' => [
                'colspan' => $this->getColspanClass()
            ],
            'view' => $this->view instanceof View ? $this->view->render() : "",
        ];
    }

    public function backbone()
    {
        return view($this->template, $this->data());
    }

    public function setReactive(callable $reactive)
    {
        $this->reactive = $reactive;
        return $this;
    }

    public function reactive($data = 'x')
    {
        if($this->reactive == null) return "x";
         $this->pass_data = $this->pass_data == null ? [] : $this->pass_data ;
        return $this->callCallable($this->reactive, ...$this->pass_data);
    }
}
