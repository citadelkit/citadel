<?php

namespace Citadel\Core\Events;

use JsonSerializable;

class CitadelEvent implements JsonSerializable {
    public static function make(...$args)
    {
        $obj = new static(...$args);
        return $obj;
    }

    public function __construct(
        protected $event,
        ...$args
    )
    {
        foreach($args as $field => $a) {
            $this->{$field} = $a;
        }
    }

    public function toArray()
    {
        return [
            "event" => $this->event
        ];
    }

    final public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
