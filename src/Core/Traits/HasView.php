<?php

namespace Citadel\Core\Traits;

use App\Services\LibraryView;
// use Illuminate\Support\Facades\View;
use Illuminate\View\View;

trait HasView
{
    protected $view = null;

    public function view($view, $data = [], $mergeData = [])
    {
        // $view instanceof View
        if ($view instanceof View) {
            $this->view = $view;
        } else if ($view instanceof LibraryView) {
            $data = $view->getData();
            $this->view = view($data['view'], $data['data']);
        } else if(is_callable($view)) {
            $this->view = $view;
        } else {
            $this->view = view($view, $data, $mergeData);
        }
        return $this;
    }
}
