<?php


namespace DefStudio\Components\View\Components;


class Zoomable extends Component
{

    public function __construct()
    {
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::zoomable');
    }
}
