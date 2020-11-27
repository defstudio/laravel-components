<?php


namespace DefStudio\Components\View\Components;


class Multiselect extends Select
{

    public function __construct(
        string $name,
        string $label = '',
        iterable $options = [],
        iterable $selected = []
    )
    {
        parent::__construct(
            $name,
            $id = '',
            $label,
            $options,
            '',
            true,
            '',
            $selected);
    }
}
