<?php

namespace Citadel\Core\Contracts;

interface CitadelElement {

    public function show($show = true);

    public function isShown($args);
}
