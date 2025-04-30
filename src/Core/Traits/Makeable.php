<?php

namespace Citadel\Core\Traits;

use Citadel\Citadel;
use Illuminate\Support\Str;

trait Makeable {
    public $name;
    public $title;

    public function getName()
    {
        return $this->name;
    }

    public static function make($name, $title = null)
    {
        Citadel::startTimer();
        $obj = new static;
        $obj->name = Str::snake($name);
        $obj->title = $title ?? $name;
        return $obj;
    }

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    private function clean($string)
    {
        return substr(preg_replace("/[^a-zA-Z0-9]+/", "", $string), 0, 100);
    }
}
