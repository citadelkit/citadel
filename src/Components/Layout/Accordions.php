<?php

namespace Citadel\Components\Layout;

use Citadel\Core\Component;
use Citadel\Core\Wrapper;

class Accordions extends Wrapper
{
    protected $tabs = [];

    public function data()
    {
        $active = null;
        $schema = collect($this->schema)
        ->filter(fn($c) => $c->isShown($this->pass_data))
        ->map(function($item, $key) use (&$active) {
            if(gettype($active) == "integer") return $item;
            // $disabled = $item->getDisabled();
            if($active == true){
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
                'inject' => fn(Accordion $component) => $component
                ->setLifecycle('backbone')
                ->passData($this->pass_data)
            ]
        );
    }

    public function backbone()
    {
        return view("citadel-component::accordions", $this->data());
    }
}
