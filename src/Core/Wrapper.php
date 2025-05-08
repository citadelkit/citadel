<?php

namespace Citadel\Core;

use Citadel\Core\Contracts\Backbone;
use Citadel\Core\Contracts\Reactive;
use Citadel\Core\Traits\CommonCitadelElement;
use Citadel\Core\Traits\HasColspan;
use Citadel\Core\Traits\HasColumns;
use Citadel\Core\Traits\HasData;
use Citadel\Core\Traits\HasSchema;
use Citadel\Core\Traits\HasView;
use Citadel\Core\Traits\Makeable;
use Error;

class Wrapper implements Reactive
{
    use CommonCitadelElement, HasSchema, HasData, Makeable, HasColumns, HasColspan, HasView;
    protected $lifecycle, $parent;
    protected $pass_data;
    protected $align = "normal";
    protected $width = null;
    protected $style = "";

    public function style($style)
    {
        $this->style = $style;
        return $this;
    }


    public function width($width)
    {
        $this->width = $width;
        return $this;
    }

    public function getWidth()
    {
        if ($this->width) return "width: $this->width;";
        return "";
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    public function setLifecycle($lifecycle)
    {
        $this->lifecycle = $lifecycle;
        return $this;
    }

    public function passData($pass_data)
    {
        $this->pass_data = $pass_data;
        return $this;
    }

    public function align($align)
    {
        $this->align = $align;
        return $this;
    }

    public function getAlignClass()
    {
        return "place-items: $this->align;";
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'style' => [
                'class' => $this->class,
                'columns' => $this->getColumnClass(),
                'colspan' => $this->getColspanClass(),
                'align' => $this->getAlignClass(),
                'width' => $this->getWidth(),
                'style' => $this->style
            ]
        ];
    }

    public function renderSchema($as_html = true, ?callable $handler = null)
    {
        // loop through schema
        // render backbone
        // passing data reference
        // set parent = $this
        // set lifecycle = 'backbone'

        $html = $as_html ? "" : [];
        if(is_callable($this->schema)) {
            $this->schema = $this->callCallable($this->schema, ...$this->pass_data);
        }

        if(is_callable($handler)) {
            $this->schema = $this->callCallable($this->schema, ...$this->pass_data);
        }

        foreach ($this->schema as $s) {
            if (!($s instanceof Backbone)) {
                throw new Error('BACKBONE[001]: Schema component must be a Backbone class, ' . gettype($s) . ' given.');
            }
            $s->setParent($this);
            $s->setLifecycle('backbone');
            $s->passData($this->pass_data);
            $show = $s->isShown($this->pass_data);

            if($this->getName() == "citadel:table_action") {
                $s->setName($s->getName() . "-" .$this->pass_data['key']);
            }

            if ($show) {
                $backbone = $s->backbone();
                if ($as_html && $backbone != null) {
                    $html .= is_string($backbone) ? $backbone : $backbone->render();
                }
                if (!$as_html) {
                    $html[] = $backbone;
                }
            }
        }
        return $html;
    }

    public function backbone()
    {

        $result = view('citadel-template::dash.wrapper', $this->data())->with('html', $this->renderSchema());
        return $result;
    }

    public function reactive()
    {
        return json_encode("OwO");
    }

    public function renderReactive(string $component_name)
    {
        if ($component_name == $this->name) return $this;
        $data = null;
        foreach ($this->schema as $s) {
            if ($s instanceof Reactive || $s instanceof Wrapper) {
                $s->setParent($this);
                $s->setLifecycle('reactive');
                $s->passData($this->pass_data);
                $data = $s->renderReactive($component_name);
            }
            if (boolval($data)) {
                return $data;
            }
        }
        return $data;
    }
}
