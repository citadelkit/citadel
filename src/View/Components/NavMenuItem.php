<?php

namespace Citadel\View\Components;

use Citadel\Components\Support\Icon;
use Citadel\View\Group\VerticalNavigation;
use Illuminate\View\Component;

class NavMenuItem extends VerticalNavigation
{
    public function __construct(
        public $icon = Icon::Activity,
        public $title = "Page Title",
        public $parent = "sideNavbar",
        public $href = "",
        public $target = "_self",
    ) {}

    public function render()
    {
        $this->icon = Icon::render($this->icon);
        $this->parent = strSnake($this->parent);
        return view("citadel-template::dash.nav.menu-item");
    }
}
