<?php

namespace Citadel\Components\Layout;

use Citadel\Core\Traits\HasIcon;
use Citadel\Core\Wrapper;

class ActionGroup extends Wrapper
{
    use HasIcon;

    protected $dropdown;
    protected $no_label = true;

    public function dropdown($dropdown = true)
    {
        $this->dropdown = $dropdown;
        return $this;
    }

    public function isDropdown()
    {
        return $this->dropdown;
    }

    public function no_label($no_label = true)
    {
        $this->no_label = $no_label;
        return $this;
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'icon' => $this->icon,
            'style' => [
                'columns' => $this->getColumnClass(),
                'colspan' => $this->getColspanClass(),
                'align' => $this->getAlignClass(),
                'width' => $this->getWidth(),
                'style' => $this->style,
            ],
            'no_label' => $this->no_label,
            'dropdown' => $this->dropdown,
        ];
    }

    public function backbone()
    {
        $html = $this->renderSchema();
        if(empty($html)) return view('citadel-template::plain', ['html' => '']);

        return view("citadel-component::action_group", $this->data())
            ->with('html', $this->renderSchema());
    }
}
