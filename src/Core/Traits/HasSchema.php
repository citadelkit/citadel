<?php

namespace Citadel\Core\Traits;

use Illuminate\Support\Collection;

trait HasSchema {
    protected $schema = [];

    public function schema($schema)
    {
        $this->schema = $schema;
        return $this;
    }
}
