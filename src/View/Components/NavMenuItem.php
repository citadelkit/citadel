<?php

namespace Citadel\View\Components;

use Citadel\Components\Support\Icon;
use Illuminate\View\Component;

class NavMenuItem extends Component
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
        return view("citadel-template::dash.nav.menu-item");
    }
}
