<?php

namespace Citadel\Components\Layout;

use Citadel\Core\Wrapper;

class Form extends Wrapper
{
    public function data()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'style' => [
                'columns' => $this->getColumnClass(),
                'colspan' => $this->getColspanClass(),
                'align' => $this->getAlignClass(),
            ]
        ];
    }

    public function backbone()
    {
        return view("citadel-component::form", $this->data())
            ->with('html', $this->renderSchema());
    }
}
