<?php

namespace Citadel\Components;

use Citadel\Core\Component;

class HeaderText extends Text
{

    public function data()
    {
        return [
            'text' => is_callable($this->title)
                ? $this->callCallable($this->title, ...$this->pass_data)
                : $this->title,
            'name' => $this->name,
            'style' => [
                'colspan' => $this->getColspanClass(),
                'class' => $this->class
            ]
        ];
    }

    public function backbone()
    {
        return view('citadel-component::header_text', $this->data());
    }
}
