<?php


namespace DefStudio\Components\View\Components;

class CheckboxSwitch extends Checkbox
{
    public function __construct(string $name, $value = '1', ?bool $checked = null, bool $inline = false)
    {
        parent::__construct($name, $value, $checked, $inline);
        $this->custom_class = 'custom-switch';
    }
}
