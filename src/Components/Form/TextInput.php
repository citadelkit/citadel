<?php

namespace Citadel\Components\Form;

use Citadel\Core\Component;

class TextInput extends Component
{
    protected $placeholder = "Text Input";
    protected $value = "";

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function password()
    {
        return $this;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function data()
    {

        return [
            "name" => $this->name,
            "title" => $this->title,
            "value" => $this->value,
            "style" => [
                "colspan" => $this->getColspanClass()
            ],
            "placeholder" => $this->placeholder,
        ];
    }

    public function backbone()
    {
        return view("citadel-component::text_input", $this->data());
    }
}
