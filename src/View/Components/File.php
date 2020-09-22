<?php


namespace DefStudio\Components\View\Components;


class File extends Input
{
    public string $label;
    public string $browseMessage;

    public function __construct(string $name, string $label = '', string $id = '', ?string $browseMessage = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->browseMessage = $browseMessage ?? ucfirst(__('def-components::files.browse'));
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::file');
    }
}
