<?php

namespace Citadel\Components;

use Citadel\Core\Layout;

class Page extends Layout {
    protected $view = "citadel-template::core";
    protected $page_setup = [];
    protected $sidebar;
    protected $header;

    public function __construct()
    {
        $this->view = config('citadel-config.views.page');
        $this->page_setup = config('citadel-config.template');
        $this->sidebar = config('citadel-config.sidebar');
        $this->header = config('citadel-config.header');
    }

    public function view($viewName)
    {
        $this->view = str_replace("citadel::", "citadel-template::", $viewName);
        return $this;
    }

    public function renderBackbone()
    {   
        return view($this->view, $this->data())
            ->with('page_title', $this->title)
            ->with('html', $this->renderSchema())
            ->with('sidebar', $this->getSidebar())
            ->with('header', $this->getHeader())
            ;
    }

    public function getSidebar()
    {
        return (new $this->sidebar)->data();
    }
    
    public function getHeader()
    {
        return (new $this->header)->data();
    }
}
