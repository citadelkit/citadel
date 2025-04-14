<?php

namespace Citadel\View\Components;

use Citadel\View\Group\VerticalNavigation;
use Illuminate\View\Component;

class HeaderNavUser extends VerticalNavigation
{
    public function __construct(
        public $user = [
            'name' => "User"
        ]
    ) {}

    public function render()
    {
        return view("citadel-template::dash.header_nav.user");
    }
}
