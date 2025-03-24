<?php

namespace Citadel\Core\Contracts;

use Stringable;

interface CitadelEnum
{
    public function label(): string;
    public function color(): string;
}
