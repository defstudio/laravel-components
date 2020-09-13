<?php


namespace DefStudio\Components\View\Components;


use Illuminate\View\Component;

class Datatable extends Component
{
    public array $headers;

    public function __construct(array $headers = [])
    {
        $this->headers = $headers;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::datatable');
    }
}
