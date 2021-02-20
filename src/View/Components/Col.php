<?php


namespace DefStudio\Components\View\Components;


class Col extends Component
{
    public function __construct(
        public string|null $size = null,
        public bool $flex = false,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::col');
    }
}
