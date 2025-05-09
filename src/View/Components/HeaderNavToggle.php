<?php

namespace Citadel\View\Components;

use Citadel\View\Group\VerticalNavigation;
use Illuminate\View\Component;

class HeaderNavToggle extends VerticalNavigation
{
    public function render() 
    {
        return view("citadel-template::dash.header_nav.toggle");
    }
}