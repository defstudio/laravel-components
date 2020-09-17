<?php


namespace DefStudio\Components\View\Components;


class Hidden extends Input
{

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::hidden');
    }
}
