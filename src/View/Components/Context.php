<?php


namespace DefStudio\Components\View\Components;

class Context extends Component
{

    public array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->context()->push($this->data);
        return view('def-components::context');
    }

}
