<?php

namespace Citadel\Components\Layout;

use Citadel\Core\Wrapper;
use Illuminate\View\View;

class Card extends Wrapper
{
    protected $no_header = true;

    public function noHeader($value = true) 
    {
        $this->no_header = $value;
        return $this;
    }
    public function backbone()
    {
        if(is_callable($this->view)) {
            $this->view($this->callCallable($this->view, ...$this->pass_data));
        }
        if ($this->view instanceof View) {
            return $this->view->with($this->data())->with('html', $this->renderSchema());
        }
        return view('citadel-component::card', $this->data())
            ->with('no_header', $this->no_header)
            ->with('html', $this->renderSchema());
    }
}
