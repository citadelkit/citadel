<?php

namespace Citadel\Components;

use Citadel\Core\Component;
use Citadel\Core\Contracts\Reactive;
use Closure;

class Chart extends Component implements Reactive
{
    protected $type = "pie";
    protected $xaxis = [];
    protected $datasets = [];
    protected $config = [];
    protected $series = [];

    public function bar($config = [])
    {
        $this->type = "bar";
        $this->config($config);
        return $this;
    }

    public function line()
    {
        $this->type = "line";
        return $this;
    }

    public function pie(
        callable|array $series,
        array $labels = [],
    )
    {
        $this->type = "pie";
        $this->datasets = compact('series', 'labels');
        return $this;
    }

    public function series($series)
    {
        $this->series = $series;
        return $this;
    }

    public function donut(
        callable|array $series,
        array $labels = [],
    )
    {
        $this->type = "donut";
        $this->datasets = compact('series', 'labels');
        return $this;
    }

    public function config($config = [])
    {
        $this->config = $config;
        return $this;
    }

    public function xaxis($xaxis)
    {
        $this->xaxis = $xaxis;
        return $this;
    }

    protected function renderDatasets()
    {
        if(is_callable($this->datasets['series'] ?? null)) {
            return Closure::fromCallable($this->datasets['series'])->call($this, ...$this->pass_data);
        }
        return $this->datasets;
    }

    public function getOptions()
    {
        $datasets = $this->renderDatasets();
        return array_filter([
            'series' => $datasets['series'] ?? $this->series,
            'xaxis' => $this->xaxis ??  [],
        ], function($item) {
            return !empty($item);
        });
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'style' => [
                'colspan' => $this->getColspanClass(),
            ],
            'config' => array_merge([
                'chart' => [
                    'type' => $this->type,
                    ...$this->config
                ],
            ], $this->renderDatasets(), $this->getOptions())
        ];
    }

    public function backbone()
    {
        return view("citadel-component::chart", $this->data());
    }

    public function reactive()
    {
        // dd($this->data());
        return $this->data()['config'];
    }
}
