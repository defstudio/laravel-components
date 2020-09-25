<?php


namespace DefStudio\Components\View\Components;

class CheckboxSwitch extends Checkbox
{
    public function __construct(
        string $name,
        $value = '1',
        $checked = false,
        bool $inline = false,
        string $id = '',
        string $modelField = 'id',
        bool $readonly = false
    )
    {
        parent::__construct($name, $value, $checked, $inline, $id, $modelField, $readonly);
        $this->custom_class = 'custom-switch';
    }
}
