<?php


namespace DefStudio\Components\View\Components;


use DefStudio\Components\Traits\HasName;
use DefStudio\Components\Traits\HasValue;

class Password extends Component
{
    use HasName;
    use HasValue;

    public string $label;

    public function __construct(string $name, string $label = '')
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
