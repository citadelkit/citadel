<?php

namespace Citadel\Components;

use App\Services\Citadel\Traits\UseURL;
use Citadel\Core\Component;
use Citadel\Core\Contracts\CitadelEnum;
use Citadel\Core\Contracts\HasLabel;
use Citadel\Core\Traits\HasColor;

class Badge extends Text
{
    use HasColor;

    protected $value = "";

    public function data()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'color' => $this->color,
            'is_html' => false,
            'style' => [
                'colspan' => $this->getColspanClass(),
                'class' => $this->class,
            ],
            'value' => $this->value,
        ];
    }

    public function value($value) {
        if($value instanceof CitadelEnum) {
            $this->value = $value->label();
            $this->color = $value->color();
        } else {
            $this->value = $value;
        }
        return $this;
    }


    public function backbone()
    {
        return view('citadel-component::badge', $this->data());
    }
}
