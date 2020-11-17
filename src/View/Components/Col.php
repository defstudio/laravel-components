<?php


namespace DefStudio\Components\View\Components;


class Col extends Component
{
    public string $size;

    public function __construct(string $size)
    {
        $this->size = $size;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::col');
    }
}
