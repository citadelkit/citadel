<?php

namespace Citadel\Core\Traits;

use Closure;
use InvalidArgumentException;
use ReflectionFunction;

trait CommonCitadelElement {
    protected $show = true;
    protected $class = "";

    public function __construct()
    {
        $this->config = config('citadel');
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function show($show = true)
    {
        $this->show = $show;
        return $this;
    }

    public function isShown($args = [])
    {
        return is_callable($this->show)
            ? $this->callCallable($this->show, ...array_merge($this->pass_data ?? [], $args))
            : boolval($this->show);
    }

    public function class($class = "")
    {
        $this->class = $class;
        return $this;
    }

    public function callCallable($callback, ...$args) {
        $reflection = new ReflectionFunction($callback);
        $parameters = $reflection->getParameters();
        $orderedArgs = [];
        foreach ($parameters as $index => $param) {
            $name = $param->getName();
            if (array_key_exists($index, $args)) {
                $orderedArgs[$name] = $args[$index];
            } elseif (array_key_exists($name, $args)) {
                $orderedArgs[$name] = $args[$name];
            } elseif ($param->isDefaultValueAvailable()) {
                $orderedArgs[$name] = $param->getDefaultValue();
            } else {
                throw new InvalidArgumentException("Missing argument: $name");
            }
        }
        return $callback(...$orderedArgs);
    }
}
