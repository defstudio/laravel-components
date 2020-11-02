<?php


namespace DefStudio\Components\View\Components;


class TemplateAttachment extends Input
{

    public string $label;
    public string $color;
    public string $filename;

    public function __construct(string $name, string $label = '', string $id = '', string $color = 'primary', ?string $filename = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->color = $color;
        $this->filename = $filename ?? $this->dashed_field_name();

    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::template-attachment');
    }
}
