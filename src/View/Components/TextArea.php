<?php


namespace DefStudio\Components\View\Components;


class TextArea extends Input
{
    public string $label;
    public int $cols;
    public int $rows;
    public ?array $summernote;

    public function __construct(
        string $name,
        string $label = '',
        string $id = '',
        int $cols = 0,
        int $rows = 0,
        ?array $summernote = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->cols = $cols;
        $this->rows = $rows;
        $this->summernote = $summernote;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::text-area');
    }
}
