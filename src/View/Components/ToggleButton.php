<?php


namespace DefStudio\Components\View\Components;


class ToggleButton extends Component
{
    public string $target;
    public string $color;


    public function __construct(
        string $target,
        string $color = 'primary'

    )
    {
        $this->target = $target;
        $this->color = $color;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::toggle-button');
    }
}
