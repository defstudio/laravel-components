<?php


namespace DefStudio\Components\View\Components;


class Alert extends Component
{

    public string $type;
    public bool $dismissable;

    public function __construct(string $type = 'primary', bool $dismissable = false)
    {
        $this->type = $type;
        $this->dismissable = $dismissable;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::alert');
    }
}
