<?php


namespace DefStudio\Components\View\Components;


class Currency extends Component
{
    public string $currency;
    public int $precision;
    public string $decimalSeparator;
    public string $thousandsSeparator;

    public function __construct(string $currency = '€', int $precision = 2, string $decimalSeparator = ',', string $thousandsSeparator = '.')
    {
        $this->currency = $currency;
        $this->precision = $precision;
        $this->decimalSeparator = $decimalSeparator;
        $this->thousandsSeparator = $thousandsSeparator;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::currency');
    }
}
