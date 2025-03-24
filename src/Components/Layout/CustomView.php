<?php

namespace Citadel\Components\Layout;

use Citadel\Core\Wrapper;
use Illuminate\View\View;
use App\Services\LibraryView;

class CustomView extends Wrapper
{
    protected $view = "citadel-template::plain";

    public function data()
    {
        return array_merge(parent::data(), $this->pass_data ?? []);
    }

    public function backbone()
    {
        if(is_callable($this->view)) {
            $this->view($this->callCallable($this->view, ...$this->pass_data));
        }
        if ($this->view instanceof View) {
            return $this->view->with($this->data())->with('html', $this->renderSchema());
        }
        return view($this->view, $this->data())->with('html', $this->renderSchema());
    }
}
