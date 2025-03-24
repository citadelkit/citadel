<?php

namespace Citadel\Core\Traits;

trait HasColumns {
    protected $columns = 1;
    protected $gap = 4;
    protected $flex = null;

    public function columns($columns = 2)
    {
        $this->columns = $columns;
        return $this;
    }

    public function gap($gap = 2)
    {
        $this->gap = $gap;
        return $this;
    }

    public function flex($flex = "")
    {
        $this->flex = $flex;
        return $this;
    }

    public function getColumnClass()
    {
        $gap = "gap: calc(.25rem*$this->gap);";
        if($this->flex) {
            return "$gap display: flex; $this->flex";
        }
        return "display: grid; grid-template-columns: repeat($this->columns, minmax(0,1fr)); $gap";
    }
}
