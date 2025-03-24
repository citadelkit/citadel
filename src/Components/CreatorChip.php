<?php

namespace Citadel\Components;

use Citadel\Core\Component;

class CreatorChip extends Component
{
    protected $picture_url = "";
    protected $title = "";
    protected $subtitle = "";
    protected $detail_url = "";

    public function data()
    {
        return [
            "picture_url" => $this->picture_url,
            "title" => $this->title,
            "subtitle" => $this->subtitle,
            "detail_url" => $this->detail_url,
        ];
    }
    public function backbone()
    {
        return view("citadel-component::creator_chip", $this->data());
    }
}
