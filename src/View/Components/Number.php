<?php


namespace DefStudio\Components\View\Components;


class Number extends Input
{
    public string $label;
    public ?int $max;
    public ?int $min;
    public string|int|float $step;

    public function __construct(
        string $name,
        string $label = '',
        string $id = '',
        int $max = null,
        int $min = null,
        string|int|float $step = 1,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->max = $max;
        $this->min = $min;
        $this->step = $step;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::number');
    }
}
