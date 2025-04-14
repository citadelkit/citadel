<?php

namespace Citadel\View\Components;

use Illuminate\View\Component;

class NavContainer extends Component
{
    public function render() 
    {
        return view("citadel-template::dash.nav.container");
    }
}