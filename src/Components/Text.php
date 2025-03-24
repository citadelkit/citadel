<?php

namespace Citadel\Components;

use Citadel\Core\Component;

class Text extends Component
{
    public function data()
    {
        return [
            'name' => $this->name,
            'text' => $this->title,
            'is_html' => false,
            'style' => [
                'colspan' => $this->getColspanClass(),
                'class' => $this->class,
            ]
        ];
    }
    public function backbone()
    {
        return view('citadel-component::text', $this->data());
    }
}
