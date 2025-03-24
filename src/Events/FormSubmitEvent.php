<?php

namespace Citadel\Events;

use Citadel\Core\Event;
use Citadel\Core\Traits\HasURL;

class FormSubmitEvent extends Event
{
    use HasURL;

    protected $name = "CForm:submit";
    protected $form_name = "";
    protected $after = "";
    protected $after_args = [];

    public function after(string $after, array $args = [])
    {
        $this->after = $after;
        $this->after_args = $args;
        return $this;
    }

    public function default()
    {
        $this->after('default');
        return $this;
    }

    public function reload()
    {
        $this->after("reload");
        return $this;
    }

    public function redirect(string $url)
    {
        $this->after("redirect", compact("url"));
        return $this;
    }

    public function doNothing()
    {
        $this->after("nothing");
        return $this;
    }

    public static function form($form_name)
    {
        $obj = new static;
        $obj->form_name = $form_name;
        return $obj;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'event' => $this->name,
            'form_name' => $this->form_name,
            'after' => $this->after,
            'url' => $this->url
        ];
    }
}
