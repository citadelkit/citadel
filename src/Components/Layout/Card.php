<?php

namespace Citadel\Components\Layout;

use Citadel\Core\Wrapper;
use Illuminate\View\View;

class Card extends Wrapper
{
    public function backbone()
    {
        if(is_callable($this->view)) {
            $this->view($this->callCallable($this->view, ...$this->pass_data));
        }
        if ($this->view instanceof View) {
            return $this->view->with($this->data())->with('html', $this->renderSchema());
        }
        return view('citadel-component::card', $this->data())->with('html', $this->renderSchema());
    }
}
