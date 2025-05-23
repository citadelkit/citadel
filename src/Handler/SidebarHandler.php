<?php

namespace Citadel\Handler;

class SidebarHandler {
    public function data()
    {
        return view('citadel-template::dash.navbar-vertical')
            ->with('brand', $this->brand());
    }

    public function brand()
    {
        return view('citadel-template::dash.nav.brand');
    }
}