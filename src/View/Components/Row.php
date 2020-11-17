<?php


namespace DefStudio\Components\View\Components;


class Row extends Component
{
    public function __construct()
    {

    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::row');
    }
}
