<?php

namespace Citadel\Components;

use Citadel\Core\Layout;
use Citadel\Handler\SidebarHandler;

class Page extends Layout {
    protected $view = "citadel-template::core";
    protected $page_setup = [];
    protected $sidebar;
    protected $header;

    public function __construct()
    {
        $this->view = config('citadel.views.page');
        $this->page_setup = config('citadel.template');
        $this->sidebar = config('citadel.sidebar');
        $this->header = config('citadel.header');
    }

    public function view($viewName)
    {
        $this->view = str_replace("citadel::", "citadel-template::", $viewName);
        return $this;
    }

    public function sidebar($sidebar_view)
    {
        $this->sidebar = $sidebar_view;
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
        $s = (is_string($this->sidebar))
            ? (new $this->sidebar)
            : $this->sidebar;
            
        if($s instanceof SidebarHandler) {
            return $s->data();
        }

        return $s;
    }
    
    public function getHeader()
    {
        return (new $this->header)->data();
    }

    public function alt1()
    {
        $this->view = 'citadel-template::core2';
        return $this;
    }
    

    public function alt0()
    {
        $this->view = 'citadel-template::basic';
        return $this;
    }
}
