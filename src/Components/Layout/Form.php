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
                'class' => $this->class,
                'columns' => $this->getColumnClass(),
                'colspan' => $this->getColspanClass(),
                'align' => $this->getAlignClass(),
                'custom' => $this->style,
            ]
        ];
    }

    public function backbone()
    {
        return view("citadel-component::form", $this->data())
            ->with('html', $this->renderSchema());
    }
}
