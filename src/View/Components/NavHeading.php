<?php

namespace Citadel\View\Components;

use Citadel\Components\Support\Icon;
use Illuminate\View\Component;

class NavHeading extends Component
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
