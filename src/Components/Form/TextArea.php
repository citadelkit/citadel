<?php

namespace Citadel\Components\Form;

use Citadel\Core\Component;

class TextArea extends Component
{

    protected $placeholder = "";
    protected $column_width;
    protected $input_layout = "vertical";
    protected $value = '';
    protected $rows = '';

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function width($width = 12)
    {
        $this->column_width = $width;
        return $this;
    }

    public function rows($rows = 5)
    {
        $this->rows = $rows;
        return $this;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

     public function data() {
        return [
            "title" => $this->title,
            'name' => $this->name,
            'input_layout' => $this->input_layout,
            'placeholder' => $this->placeholder,
            'column_width' => $this->column_width,
            'rows' => $this->rows,
            'value' =>$this->value,
            'style' => [
                "colspan" => $this->getColspanClass()
            ],
        ];
    }

    public function backbone()
    {
        return view("citadel-component::text_area", $this->data());
    }
}
