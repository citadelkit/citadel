<?php

namespace Citadel\Components\Form;

use Citadel\Core\Component;

class TextInput extends Component
{
    protected $placeholder = "Text Input";
    protected $value = "";
    protected $type = "text";

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }
    
    public function password()
    {
        $this->type = "password";
        return $this;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    public function data()
    {

        return [
            "name" => $this->name,
            "title" => $this->title,
            "value" => $this->value,
            "type" =>$this->type,
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
