<?php

namespace Citadel\Core\Contracts;

interface Reactive extends Backbone {
    /**
     * Traversing through component to find reactive component;
     */
    public function renderReactive(string $component_name);

    /**
     * Actual data returned on reactive phase
     */
    public function reactive();
}
