<?php


namespace DefStudio\Components\View\Components;


use Illuminate\View\Component;

class Hidden extends Component
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
        return view('def-components::hidden');
    }
}
