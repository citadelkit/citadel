<?php

namespace Citadel\Core;

use JsonSerializable;

class Event implements JsonSerializable {
    protected $name = "CEvent:hello";

    public function jsonSerialize(): mixed
    {
        return [
            'event' => $this->name
        ];
    }
}
