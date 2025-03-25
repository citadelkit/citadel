<?php

namespace Citadel\Components;

use Citadel\Core\Layout;

class Page extends Layout {
    protected $view = "citadel-template::core";
    protected $page_setup = [];

    public function __construct()
    {
        $this->view = config('citadel-config.views.page');
        $this->page_setup = config('citadel-config.template');
    }

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
