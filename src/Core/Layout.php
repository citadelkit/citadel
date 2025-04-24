<?php

namespace Citadel\Core;

use Citadel\Core\Contracts\Backbone;
use Citadel\Core\Traits\HasColumns;
use Citadel\Core\Traits\HasData;
use Citadel\Core\Traits\HasSchema;
use Citadel\Core\Traits\Makeable;
use Citadel\Core\Contracts\Reactive;
use Citadel\Core\Traits\CommonCitadelElement;
use Closure;
use Error;
use Illuminate\Support\Facades\View;

class Layout {
    use CommonCitadelElement, HasSchema, HasData, Makeable, HasColumns;

    protected $business = null;

    public function data()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'style' => [
                'columns' => $this->getColumnClass()
            ]
        ];
    }

    public function pageInfoShare()
    {
        $user = new class {};
        $current_user_position = $user->current_position ?? new class {};
        $settings = [];
        $page_info = [
            'name' => $this->name,
            'title' => $this->title,
            'prefix' => "WISE",
            'site_name' => "WISE"
        ];

        View::share(compact('page_info', 'user', 'current_user_position') + [
            'is_view_only' => false
        ]);
    }

    public function render()
    {
        // is_parser

        // is_reactive
        if(request()->get('f') == "reactive") {
            return $this->renderReactive(request()->get('c'));
        }
        // is_backbone
        return $this->renderBackbone();
    }

    public function business(callable $business)
    {
        $this->business = $business;
        return $this;
    }

    // loop through schema
    // render backbone
    // passing data reference
    // set parent = $this
    // set lifecycle = 'backbone'
    protected function renderSchema()
    {

        $this->pageInfoShare();
        $html = "";
        $business = $this->getBusinessData();
        foreach ($this->schema as $s) {
            if(!($s instanceof Backbone)) {
                throw new Error('BACKBONE[001]: Schema component must be a Backbone class, '. gettype($s). ' given.' . json_encode($s));
            }
            $s->setParent($this);
            $s->setLifecycle('backbone');
            $s->passData($business);
            if($s->isShown($business)) {
                try {
                    $html .= $s->backbone()->render();
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }
        return $html;
    }

    protected function getBusinessData()
    {
        $business = is_callable($this->business) ? Closure::fromCallable($this->business)->call($this) : [];
        return $business;
    }

    public function renderBackbone()
    {
        return view('citadel-template::core', $this->data())->with('html', $this->renderSchema());
    }

    public function renderReactive(string $component_name)
    {
        $x = [];
        $data = null;
        foreach ($this->schema as $s) {
            if($s instanceof Reactive) {
                $s->setLifecycle('reactive');
                $s->passData($this->getBusinessData());
                $data = $s->renderReactive($component_name);
                $x[] = $data;
            }
            if($data != null) {
                return $data->reactive();
            }
        }
        throw new Error("Reactive Component Not Found for \"$component_name\"");
    }
}
