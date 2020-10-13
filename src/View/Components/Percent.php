<?php


namespace DefStudio\Components\View\Components;


class Percent extends Input
{
    public string $label;
    public ?int $max;
    public ?int $min;
    public $append = '%';

    public function __construct(
        string $name,
        string $label = '',
        string $id = '',
        int $max = 100,
        int $min = 0
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->max = $max;
        $this->min = $min;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::number');
    }
}
