<?php


namespace DefStudio\Components\View\Components;


class ZoomButton extends Component
{

    public string $icon;
    public string $color;

    public function __construct(string $icon = 'search', string $color = 'primary')
    {
        $this->icon = $icon;
        $this->color = $color;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::zoom-button');
    }
}
