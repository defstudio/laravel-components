<?php


namespace DefStudio\Components\View\Components;


use Illuminate\Support\Str;

class NavbarNav extends Component
{

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::navbar-nav');
    }
}
