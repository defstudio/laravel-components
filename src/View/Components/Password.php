<?php


namespace DefStudio\Components\View\Components;


use Illuminate\View\Component;

class Password extends Component
{
    public string $name;
    public string $label;

    public function __construct(string $name, string $label='')
    {
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::password');
    }
}
