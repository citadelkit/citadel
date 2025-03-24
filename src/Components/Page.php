<?php

namespace Citadel\Components;

use Citadel\Core\Layout;

class Page extends Layout {
    protected $view = "citadel-template::core";

    public function view($viewName)
    {
        $this->view = str_replace("citadel::", "citadel-template::", $viewName);
        return $this;
    }

    public function renderBackbone()
    {   
        return view($this->view, $this->data())->with('html', $this->renderSchema());
    }
}
