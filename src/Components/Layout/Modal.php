<?php

namespace Citadel\Components\Layout;

use Citadel\Core\Wrapper;

class Modal extends Wrapper
{
    protected $width = "20vw";
    protected $backdrop = true;
    protected $body_scroll = false;

    public function backdrop($backdrop = true)
    {
        $this->backdrop = $backdrop;
        return $this;
    }

    public function bodyScroll($body_scroll = true)
    {
        $this->body_scroll = $body_scroll;
        return $this;
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'width' => $this->width,
            'style' => [
                'columns' => $this->getColumnClass(),
            ],
            'body_scroll' => $this->body_scroll,
            'backdrop' => $this->backdrop,
            'config' => [

            ]   
        ];
    }

    public function backbone()
    {
        return view("citadel-component::modal", $this->data())
            ->with('html', $this->renderSchema());
    }
}
