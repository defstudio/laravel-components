<?php


namespace DefStudio\Components\View\Components;


class Percent extends Input
{
    public string $label;
    public ?float $max;
    public ?float $min;
    public $append = '%';
    public string|int|float $step;

    public function __construct(
        string $name,
        string $label = '',
        string $id = '',
        float $max = 100,
        float $min = 0,
        string|int|float $step = 1
    ) {
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
