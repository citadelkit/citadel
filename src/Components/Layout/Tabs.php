<?php

namespace Citadel\Components\Layout;

use Citadel\Core\Component;
use Citadel\Core\Wrapper;

class Tabs extends Wrapper
{
    protected $tabs = [];

    public function data()
    {
        $active = null;
        $schema = collect($this->schema)
        ->filter(fn($c) => $c->isShown($this->pass_data))
        ->map(function($item, $key) use (&$active) {
            if(gettype($active) == "integer") return $item;
            $disabled = $item->getDisabled();
            if(!$disabled && $active == null) {
                $item->active(true);
                $active = $key;
            }
            return $item;
        });
        return array_merge(
            parent::data(),
            [
                'schema' => $schema,
                // 'content' => $this->renderSchema(),
                'inject' => fn(Tab $component) => $component
                ->setLifecycle('backbone')
                ->passData($this->pass_data)
            ]
        );
    }

    public function backbone()
    {
        return view("citadel-component::tabs", $this->data());
    }
}
