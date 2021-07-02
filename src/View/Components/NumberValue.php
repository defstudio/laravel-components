<?php


namespace DefStudio\Components\View\Components;


use Illuminate\Contracts\View\View;

class NumberValue extends Input
{
    public function __construct(
        public string $name = '',
        public string $um = '',
        public int $precision = 2,
        public string $decimalSeparator = ',',
        public string $thousandsSeparator = '.'
    )
    {
    }

    public function render(): View
    {
        return view('def-components::number-value');
    }
}
