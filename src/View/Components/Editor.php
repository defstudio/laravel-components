<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;


class Editor extends Input
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
        ?array $summernote = ['style', 'font', 'color', 'paragraphs']
    ) {
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
