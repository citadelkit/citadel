<?php

namespace Citadel\Core\Contracts;

interface Backbone extends CitadelElement {
    public function setParent($parent);

    public function setLifecycle($lifecycle);

    public function passData($ancestor);

    public function backbone();
}
