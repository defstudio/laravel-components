<?php


namespace DefStudio\Components\View\Components;


class Currency extends Component
{
    public string $currency;
    public int $precision;

    public function __construct(string $currency = '€', int $precision = 2)
    {
        $this->currency = $currency;
        $this->precision = $precision;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::currency');
    }
}
