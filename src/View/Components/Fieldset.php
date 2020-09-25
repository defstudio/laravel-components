<?php


namespace DefStudio\Components\View\Components;


class Fieldset extends Component
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::fieldset');
    }
}
