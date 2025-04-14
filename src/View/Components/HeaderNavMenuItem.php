<?php

namespace Citadel\View\Components;

use Citadel\Components\Support\Icon;
use Citadel\View\Group\VerticalNavigation;
use Illuminate\View\Component;

class HeaderNavMenuItem extends VerticalNavigation
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
        return view("citadel-template::dash.header_nav.menu-item");
    }
}
