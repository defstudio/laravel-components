<?php


namespace DefStudio\Components\View\Components;


use DefStudio\Components\Traits\HasName;
use DefStudio\Components\Traits\HasValue;

class Hidden extends Component
{
    use HasValue;
    use HasName;

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
