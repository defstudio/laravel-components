<?php


namespace DefStudio\Components\View\Components;


class FloatNumber extends Number
{
    public function __construct(
        string $name,
        string $label = '',
        string $id = '',
        int $max = null,
        int $min = null,
        string|int|float $step = 'any',
    )
    {
        parent::__construct($name, $label, $id, $max, $min, $step);
    }
}
