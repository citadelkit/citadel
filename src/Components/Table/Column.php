<?php

namespace Citadel\Components\Table;

use Carbon\Carbon;
use Citadel\Components\Badge;
use Citadel\Components\CreatorChip;
use Citadel\Core\Component;
use Citadel\Core\Contracts\Backbone;
use Illuminate\View\View;

class Column extends Component
{
    protected $searchable = false;
    protected $orderable = false;
    protected $width = null;
    protected $value = null;
    protected $align = "left";

    public function align($align = "left")
    {
        $this->align = $align;
        return $this;
    }

    public function width($width)
    {
        $this->width = $width;
        return $this;
    }
    public function badge() {
        $this->value(function ($value) {
            if (is_string($value)) {
                $arr = json_decode($value);
            }
            if ((isset($arr) && is_array($arr)) || is_array($value)) {

                if(is_array($value)) {
                    $arr = $value;
                }
                if (empty($arr)) {
                    return "";
                }
                $fulltext = implode(', ', $arr);
                $badges = [
                    array_slice($arr, 0, 1)[0],
                    count(array_slice($arr, 1)),
                ];
                $text = $badges[0];
                if ($badges[1] > 0) {
                    $text .= " + $badges[1] " . __("more");
                }

                $html = view('citadel-component::badge', [
                    'text' => __($text),
                    'color' => 'light',
                    'fulltext' => $fulltext,
                ])->render();
                return $html;
            }

            $label = method_exists($value ?? '', 'label') ? $value->label() : $value;
            $color = method_exists($value ?? '', 'color') ? $value->color() : "light";
            $slug = method_exists($value ?? '', 'slug') ? $value->slug() : $value;

            return view('citadel-component::badge', [
                'text' => optional($value)->label() ?? (string) $value,
                'color' => $color,
                'fulltext' => $value,
                'slug' => $slug,
            ])->render();
        });
        return $this;

    }

    public function orderable($orderable = true)
    {
        $this->orderable = $orderable;
        return $this;
    }

    public function searchable($searchable = true)
    {
        $this->searchable = $searchable;
        return $this;
    }

    public function dateformat($format = "d-m-Y H:i:s")
    {
        $this->value(function ($value) use ($format) {
            setlocale(LC_ALL, '');
            if (!$value) {
                return null;
            }
            if ($value instanceof Carbon) {
                return  "<div style='white-space: nowrap'>" . $value->format($format) . "</div>";
            }
            return  "<div style='white-space: nowrap'>" . Carbon::createFromFormat('Y-m-d H:i:s', $value)->format($format) . "</div>";
        });
        return $this;
    }

    public function backbone()
    {
        return "<th name='$this->name'>$this->title</th>";
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function applyValue($args)
    {
        if(is_callable($this->value)) {
            $p = $this->callCallable($this->value, ...array_merge($this->pass_data, $args));
        } else {
            $p = $this->value;
        }

        if($p instanceof Backbone) {
            $p->passData(array_merge($this->pass_data, $args));
            return $p->backbone()->render();
        }

        if($p instanceof View) {
            return $p->render();
        }

        return $p;
    }

    public function definition()
    {
        $levels = explode('.',$this->name);
        $count = count($levels);
        return [
            'title' => $this->title,
            'name' => $this->name,
            'levels' => $levels,
            'has_levels' => $count > 1,
            'relations' => implode(".",array_slice($levels, 0, $count-1)),
            'field_name' => array_slice($levels, $count-1, $count)[0],
            'data' => $this->name,
            'searchable' => $this->searchable,
            'orderable' => $this->orderable,
            'width' => $this->width
        ];
    }
}
