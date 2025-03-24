<?php

namespace Citadel\Components\Form;

use Citadel\Core\Component;
use Illuminate\Support\Collection;

class SelectInput extends TextInput
{
    protected $placeholder = "";
    protected $options = [];
    protected $reactive = false;
    protected $persist = "";
    protected $maxItems = null;
    protected $valueField = "id";
    protected $searchField = "title";
    protected $labelField = "title";
    protected $multiple = false;
    // USE SELECT2

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function multiple($multiple = true)
    {
        $this->multiple = $multiple;
        return $this;
    }

    public function options(Collection|string|array|callable $options)
    {
        $this->options = $options;

        if(is_callable($options)) $this->reactive = true;
        return $this;
    }

    public function getOptions()
    {
        $options = $this->options;
        if($this->lifecycle == "reactive") {
            $options = is_callable($options) ? $this->callCallable($options, ...['q' => request()->q],...$this->pass_data) : $options;
            return [
                'results' => collect($options)
                    ->map(function($i) {
                        return [
                            "id" => $i[$this->valueField],
                            "text" => $i[$this->labelField],
                        ];
                    })
            ];
        }
        if($this->lifecycle == "backbone") {
            if(is_string($options)) {
                $options = $this->enumOptions($options);
            } elseif ($options instanceof Collection) {
                return $options->toArray();
            }
            return $options;
        }
        return[];
    }

    private function enumOptions(string $options)
    {
        if (is_string($options)) {
            if (enum_exists($options)) {
                $options = collect(($options)::cases())->reduce(function ($acc, $i) {
                    $acc[$i->value] = optional($i)->label() ?? $i->value;
                    return $acc;
                }, []);
            }
        }
        return $options;
    }

    public function persist($persist)
    {
        $this->persist = $persist;
        return $this;
    }

    public function maxItems($maxItems)
    {
        $this->maxItems = $maxItems;
        return $this;
    }

    public function valueField($valueField)
    {
        $this->valueField = $valueField;
        return $this;
    }

    public function searchField($searchField)
    {
        $this->searchField = $searchField;
        return $this;
    }

    public function labelField($labelField)
    {
        $this->labelField = $labelField;
        $this->searchField = $labelField;
        return $this;
    }

    public function data()
    {
        return [
            "name" => $this->multiple ? "$this->name[]" : $this->name,
            "identifier" => $this->identifier ?? $this->name,
            "title" => $this->title,
            "value" => $this->value,
            "definition" => [
                "reactive" => $this->reactive,
                "config" => [
                    // 'persist' => $this->persist,
                    // 'maxItems' => $this->maxItems,
                    'valueField' => $this->valueField,
                    'labelField' => $this->labelField,
                    'searchField' => $this->searchField,
                    // 'options' => $this->getOption(),
                    // 'render' => $this->render,
                    // 'createFilter' => $this->createFilter,
                    // 'create' => $this->create,
                    // 'setValue' =>$this->setValue,
                    // 'lock' =>$this->lock
                ],
            ],
            "style" => [
                "colspan" => $this->getColspanClass()
            ],
            "placeholder" => $this->placeholder ?? $this->title,
            // "multiple" => $this->multiple,
            "options" => $this->getOptions()
        ];
    }

    public function backbone()
    {
        return view("citadel-component::select_input", $this->data());
    }

    public function reactive()
    {
        $options = $this->getOptions();
        return $options;
    }
}
