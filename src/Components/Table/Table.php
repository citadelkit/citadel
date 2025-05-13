<?php

namespace Citadel\Components\Table;

use Citadel\Components\Control\Button;
use Citadel\Components\Layout\ActionGroup;
use Citadel\Components\Layout\Flyout;
use Citadel\Components\Layout\Form;
use Citadel\Components\Support\Icon;
use Citadel\Components\Text;
use Citadel\Core\Component;
use Citadel\Core\Contracts\Reactive;
use Citadel\Core\Layout;
use Citadel\Core\Wrapper;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;

class Table extends Wrapper
{
    protected $query;
    protected $array;
    protected $default = [];
    protected $filters = [];
    protected $actions = [];
    protected $mode = "basic";
    protected $numbering = false;
    protected $method = "get";

    public function actions($actions)
    {
        $this->actions = $actions;
        return $this;
    }

    protected function filterName()
    {
        return "filter-$this->name";
    }

    public function filters($filters)
    {
        $this->filters = collect($filters)
            ->map(fn(Component $item) => $item->setIdentifier("filter:" . $item->getName()));
        // dd($this->filters[0]->backbone()->render());
        return $this;
    }

    public static function ApplyFilter($form_name, $table_name)
    {
        return [
            "event" => "CTable:apply-filter",
            "form_name" => $form_name,
            "table_name" => $table_name,
        ];
    }

    public static function ResetFilter($form_name, $table_name)
    {
        return [
            "event" => "CTable:reset-filter",
            "form_name" => $form_name,
            "table_name" => $table_name,
        ];
    }

    public static function ReloadTable($form_name, $table_name)
    {
        return [
            "event" => "CTable:reload",
            "form_name" => $form_name,
            "table_name" => $table_name,
        ];
    }

    public function getFilterComponent()
    {
        $form_name = "form-filter-$this->name";
        return [
            'flyout' => fn() => $this->mode == "normal" ? Flyout::make($this->filterName(), "Filter $this->title")
                ->schema([
                    Form::make($form_name)
                        ->schema($this->filters),
                    Wrapper::make("action")
                        ->columns(6)
                        ->gap(1)
                        ->schema([
                            Button::make("Reset")
                                ->color('warning')
                                ->onClick(static::ResetFilter(
                                    form_name: $form_name,
                                    table_name: $this->name
                                ))
                                ->colspan(2),
                            Button::make("Apply Filter")
                                ->onClick(static::ApplyFilter(
                                    form_name: $form_name,
                                    table_name: $this->name
                                ))
                                ->colspan(4)
                        ])
                ])
                ->backdrop(false)
                ->bodyScroll(true)
                ->setParent($this)
                ->setLifecycle('backbone')
                ->passData($this->pass_data)
                ->backbone()
                ->render() : "",
            'button' => fn() => $this->mode == "normal" ? Button::make('Filter')
                ->icon(Icon::Filter)
                ->attr("data-bs-toggle=offcanvas role=button aria-controls=" . $this->filterName() . "")
                ->url("#" . $this->filterName())
                ->backbone()
                ->render() : "",
            'button2' => fn() => $this->mode == "normal" ? Button::make('Reload')
                ->icon(Icon::RefreshCw)
                ->color('info')
                ->onClick(static::ReloadTable(
                    form_name: $form_name,
                    table_name: $this->name
                ))
                ->backbone()
                ->render() : "",
        ];
    }

    /**
     * Table row numbering/indexing
     */
    public function numbering($numbering = true)
    {
        $this->numbering = $numbering;
        return $this;
    }

    /**
     * Table request via POST
     *
     * Support longer column and search data
     * Require [Get,Post] endpoint OR Route::citadel() macro
     *
     * @param string $method "get" or "post"
     * @return static
     */
    public function method($method = "get")
    {
        $this->method = $method;
        return $this;
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'style' => [
                'columns' => $this->getColumnClass(),
                'colspan' => $this->getColspanClass(),
                'align' => $this->getAlignClass(),
            ],
            'definition' => [
                'config' => array_merge($this->default, [
                    'columns' => $this->getColumnDefinition(),
                ]),
                'method' => $this->method,
                'numbering' => $this->numbering
            ],
            'mode' => $this->mode,
            'filter' => $this->getFilterComponent(),
        ];
    }

    public function normal()
    {
        $this->mode = "normal";
        $this->default = [
            'processing' => true,
            'serverSide' => true,
            'paging' => true,
            'searching' => true,
            'layout' => [
                'topStart' => 'search',
                'topEnd' => [
                    'div' => [
                        'id' => "button-" . $this->filterName(),
                    ]
                ],
                'bottomStart' => ['info', 'pageLength'],
                'bottomEnd' => 'paging'
            ],
        ];
        return $this;
    }

    public function basic()
    {
        $this->mode = "basic";
        $this->default = [
            'serverSide' => false,
            'paging' => false,
            'searching' => false,
            'layout' => [
                // 'topStart' => 'search',
                'bottom' => 'paging',
                'bottomStart' => null,
                'bottomEnd' => null
            ],
        ];
        return $this;
    }

    /**
     * Get Table Column Definition
     */
    public function getColumnDefinition()
    {
        $columns = collect([]);
        foreach ($this->schema as $col) {
            $columns[] = $col->definition();
        }
        return $columns;
    }

    public function preProcessing()
    {
        // Add Action Column Here
        if (!empty($this->actions)) {
            array_unshift(
                $this->schema,
                Column::make('action', __("Action"))
                    ->value(fn(&$model, &$key) => ActionGroup::make('citadel:table_action')
                        ->style("min-width: 100px;")
                        ->passData(['model' => $model, "key" => $key])
                        ->schema($this->actions))
            );
        }
        if ($this->numbering) {
            array_unshift(
                $this->schema,
                Column::make('no', __("No"))
                    ->value(fn($model) => ActionGroup::make('action')
                        ->style("min-width: 100px;")
                        ->passData($model)
                        ->schema($this->actions))
            );
        }

        $this->schema = collect($this->schema)
            ->filter(fn($item) => $item->passData($this->pass_data)->isShown())
            ->toArray();
    }

    public function backbone()
    {
        $this->preProcessing();
        return view('citadel-component::table', $this->data())
            ->with('columns', $this->renderSchema());
    }

    public function query(callable|DatabaseQueryBuilder|Builder $query)
    {
        $this->query = $query;
        return $this;
    }

    public function array(callable|array $array)
    {
        $this->array = $array;
        return $this;
    }


    private function handleRelation(&$query, $columns) {}

    protected function  preFetch($query)
    {
        $columns = $this->getColumnDefinition();
        // Set Relation
        $query->with($columns->map(function ($i) {
            return $i['has_levels'] ? $i['relations'] : null;
        })->filter()->toArray());

        $keys = [];
        foreach ($this->filters as $f) {
            $name = $f->getName();
            if ($value = request()->get($name)) {
                $keys[$name] = $value;
            }
        }

        $query->when(
            count($keys) > 0,
            function ($q) use ($keys) {
                $q->where($keys);
            }
        );

        // Column
        $query
            ->when(
                request()->search,
                function ($q, $search) use ($columns) {
                    $q->where(function ($q1) use ($columns, $search) {
                        foreach ($columns as $c) { // ilike not support sqllite
                            if (!$c['has_levels'] && $c['searchable']) {
                                $q1->orWhereRaw("LOWER({$c['name']}) LIKE ?", ['%' . strtolower($search['value']) . '%']);
                            } else if ($c['has_levels'] && $c['searchable']) {
                                $q1->orWhereHas($c['relations'], function ($q) use ($c, $search) {
                                    $q->whereRaw("LOWER({$c['field_name']}) LIKE ?", ['%' . strtolower($search['value']) . '%']);
                                });
                            }
                        }
                    });
                    // dd($q->toSql());
                }
            );

        // Order

        $query
            ->when(
                request()->order[0] ?? null,
                function ($q, $order) use ($columns) {
                    $c = $columns[$order['column']] ?? null;
                    if ($c && !$c['has_levels']) {
                        if ($c['orderable']) $q->orderBy($order['name'], $order['dir']);
                    }
                }
            );

        return $query;
    }

    protected function preFetchArray($array)
    {
        $columns = $this->getColumnDefinition();
        $searchableNames = array_column(array_filter($columns->toArray(), fn($col) => $col['searchable'] === true), 'name');
        $orderables = array_column(array_filter($columns->toArray(), fn($col) => $col['orderable'] === true), 'name');

        // search
        $search = request()->search;
        $filtered = array_filter($array, function ($item) use ($searchableNames, $search) {
            foreach ($searchableNames as $field) {
                if (isset($item[$field]) && stripos($item[$field], $search['value']) !== false) {
                    return true;
                }
            }
            return false;
        });

        // order
        $order = request()->get('order', []);
        if (!empty($order) && isset($order[0])) {
            $orderColumnIndex = $order[0]['column'];
            $orderDirection = strtolower($order[0]['dir']) === 'desc' ? SORT_DESC : SORT_ASC;

            $columnDefs = $columns->toArray();
            if (isset($columnDefs[$orderColumnIndex])) {
                $orderColumnName = $columnDefs[$orderColumnIndex]['name'] ?? null;

                if ($orderColumnName && in_array($orderColumnName, $orderables)) {
                    usort($filtered, function ($a, $b) use ($orderColumnName, $orderDirection) {
                        $valueA = $a[$orderColumnName] ?? null;
                        $valueB = $b[$orderColumnName] ?? null;

                        return $orderDirection === SORT_DESC
                            ? strcmp($valueB, $valueA)
                            : strcmp($valueA, $valueB);
                    });
                }
            }
        }


        return $filtered;
    }

    protected function postFetch($data, $schema)
    {
        $data = collect($data)->map(function ($model, $key) use ($schema) {
            $new = is_array($model) ? $model : $model->toArray();
            foreach ($schema as $column) {
                $value = is_array($model) ? ($model[$column->getName()] ?? null) : ($model->{$column->getName()} ?? null);
                $column->passData([...$this->pass_data]);
                $newValue = $column->applyValue(compact('value', 'model', 'key'));
                if ($newValue != null) {
                    $new[$column->getName()] = $newValue;
                }
            }
            return $new;
        });
        return $data;
    }

    public function renderReactive(string $component_name)
    {
        if ($component_name == $this->name) return $this;
        $comp = explode(":", $component_name);
        $data = null;
        // Handle component fetch from c=filter:$component_name for filters
        if ($comp[0] == "filter" && count($comp) > 1) {
            foreach ($this->filters as $s) {
                if ($s instanceof Reactive || $s instanceof Wrapper) {
                    $s->setParent($this);
                    $s->setLifecycle('reactive');
                    $s->passData($this->pass_data);
                    $data = $s->renderReactive($comp[1]);
                }
                if (boolval($data)) {
                    return $data;
                }
            }
        }

        return parent::renderReactive($component_name);
    }

    protected function getQuery()
    {
        if (is_callable($this->query)) {
            return $this->callCallable($this->query, ...$this->pass_data);
        }
        return clone $this->query;
    }

    protected function getArray()
    {
        if (is_callable($this->array)) {
            return $this->callCallable($this->array, ...$this->pass_data);
        }
        return $this->array ?? [];
    }

    public function reactive()
    {
        $this->preProcessing();

        $order = request()->get('order');
        $search = request()->get('search');
        $offset = request()->get('start');
        $limit = request()->get('length');
        if ($this->query) {
            $total_count = $this->getQuery()->count();
            $preparedQuery = $this->preFetch($this->getQuery());
            $filtered_count = $preparedQuery->count(); //if count error check sql support

            $data = $preparedQuery
                ->when($offset, fn($q) => $q->offset($offset))
                ->when($limit, fn($q) => $q->limit($limit))
                ->get();
            $data = $this->postFetch($data, $this->schema);
        }
        //if using array
        if ($this->array) {
            $preparedArray = $this->preFetchArray($this->getArray());
            $data = $this->postFetch(array_slice($preparedArray, $offset, $limit), $this->schema);
            $total_count =  count($this->getArray());
            $filtered_count = count($preparedArray);
        }

        return [
            "draw" => request()->get('draw'),
            "recordsTotal" => $total_count ?? 0,
            "recordsFiltered" => $filtered_count ?? 0,
            "data" => $data ?? []
        ];
    }
}
