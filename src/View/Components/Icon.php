<?php


namespace DefStudio\Components\View\Components;


use Illuminate\View\Component;

class Icon extends Component
{
    public string $name;
    public string $type;

    public function __construct(string $name, string $type='fas')
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::icon');
    }
}
