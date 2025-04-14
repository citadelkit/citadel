<?php

namespace Citadel\View\Components;

use Citadel\Components\Support\Icon;
use Citadel\View\Group\VerticalNavigation;
use Illuminate\View\Component;

class NavHeading extends VerticalNavigation
{
    public function __construct(
        public $icon = Icon::Activity,
        public $title = "Heading",
    ) {}

    public function render()
    {
        $this->icon = Icon::render($this->icon);
        return view("citadel-template::dash.nav.heading");
    }
}
