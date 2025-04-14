<?php

namespace Citadel\View\Components;

use Citadel\View\Group\VerticalNavigation;
use Illuminate\View\Component;

class HeaderNavNotification extends VerticalNavigation
{
    public $notifications = [];
    
    public function __construct(
        array $notifications = []
    ) {
        $this->notifications = $notifications;
    }

    public function render()
    {
        return view("citadel-template::dash.header_nav.notification");
    }
}
