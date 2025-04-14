<?php

namespace Citadel\View\Components;

use Citadel\View\Group\VerticalNavigation;
use Illuminate\View\Component;

class HeaderNavSearch extends VerticalNavigation
{
    public function render() 
    {
        return view("citadel-template::dash.header_nav.search");
    }
}