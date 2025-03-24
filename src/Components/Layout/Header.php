<?php

namespace Citadel\Components\Layout;

use Citadel\Core\Wrapper;

class Header extends Wrapper
{
    public function data()
    {
        return [
            'title' => is_callable($this->title)
                ? $this->callCallable($this->title, ...$this->pass_data)
                : $this->title,
            'name' => $this->name,
            'style' => [
                'columns' => $this->getColumnClass(),
                'colspan' => $this->getColspanClass(),
                'align' => $this->getAlignClass(),
                'width' => $this->getWidth(),
                'style' => $this->style
            ]
        ];
    }

    public function backbone()
    {
        return view('citadel-component::header', $this->data())->with('html', $this->renderSchema());
    }
}
