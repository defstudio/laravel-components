<?php


namespace DefStudio\Components\View\Components;


class Text extends Input
{
    public string $label;

    public function __construct(string $name, string $label = '', string $id = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::text');
    }
}
