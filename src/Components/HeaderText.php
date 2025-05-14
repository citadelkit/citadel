<?php

namespace Citadel\Components;

use Citadel\Core\Component;

class HeaderText extends Text
{

    protected $text_class = "";

    public function textClass($text_class)
    {
        $this->text_class = $text_class;
        return $this;
    }

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
            ],
            'text_class' => [
                'class' => $this->text_class
            ]
        ];
    }

    public function backbone()
    {
        return view('citadel-component::header_text', $this->data());
    }
}
