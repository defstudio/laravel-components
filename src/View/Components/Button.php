<?php


namespace DefStudio\Components\View\Components;


class Button extends \Illuminate\View\Component
{
    public string $href;
    public string $color;
    public string $type;

    public function __construct(string $url='', string $route = '', string $color='primary', string $type='button')
    {
        $this->href = empty($route)?$url:route($route);
        $this->color = $color;
        $this->type = $type;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::button');
    }
}
