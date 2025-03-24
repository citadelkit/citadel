<?php

namespace Citadel\Components\Layout;

use App\Services\LibraryView;
use Citadel\Core\Component;
use Citadel\Core\Traits\HasDisabled;
use Citadel\Core\Traits\HasView;
use Citadel\Core\Wrapper;

class Accordion extends Wrapper
{
    use HasView, HasDisabled;

    protected $active = false;

    public function active($active = true)
    {
        $this->active = $active;
        return $this;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'active' => $this->active,
            'style' => [
                'columns' => $this->getColumnClass(),
                'colspan' => $this->getColspanClass(),
                'align' => $this->getAlignClass(),
                'width' => $this->getWidth(),
                'style' => $this->style
            ]
        ];
    }

    public function backboneLabel()
    {
        return view("citadel-component::tab_label", [
            'name' => $this->name,
            'title' => $this->title,
            'active' => $this->active,
            'disabled' => $this->getDisabled()
        ]);
    }

    public function backbone()
    {
        if($this->getDisabled()) return view("citadel-component::accordion", $this->data())
            ->with('html', 'disabled');
        if($this->view) {
            if(is_callable($this->view)) {
                $this->view($this->callCallable($this->view, ...$this->pass_data));
            }
            return view("citadel-component::accordion", $this->data())
                ->with('html', $this->view->render());
        }

        return view("citadel-component::accordion", $this->data())
            ->with('html', $this->renderSchema());
    }
}
