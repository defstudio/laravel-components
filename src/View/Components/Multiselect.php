<?php


namespace DefStudio\Components\View\Components;


class Multiselect extends Select
{

    public function __construct(
        string $name,
        string $label = '',
        array $options = [],
        array $selected = []
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
