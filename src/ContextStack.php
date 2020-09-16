<?php


namespace DefStudio\Components;


use Illuminate\Support\Arr;

class ContextStack
{
    protected array $stack = [];

    public function push(array $data)
    {
        $this->stack[] = array_merge($this->read(), $data);
    }

    public function read(): array
    {
        return Arr::last($this->stack) ?? [];
    }

    public function pop()
    {
        array_pop($this->stack);
    }
}
