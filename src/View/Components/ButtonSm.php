<?php


namespace DefStudio\Components\View\Components;


class ButtonSm extends Button
{
    public string $href;
    public string $color;
    public string $type;

    public function __construct(string $url='', string $route = '', string $color='primary', string $type='button')
    {
        parent::__construct($url, $route, $color, $type);

        $this->attributes->merge([
            'class' => 'btn-sm'
        ]);
    }



    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::button');
    }
}
