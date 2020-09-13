<?php


namespace DefStudio\Components\View\Components;


use Illuminate\View\Component;

class Text extends Component
{
    public string $name;
    public string $label;
    public string $autocomplete;

    public function __construct(string $name, string $label='', string $autocomplete='off')
    {
        $this->name = $name;
        $this->label = $label;
        $this->autocomplete = $autocomplete;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::text');
    }
}
