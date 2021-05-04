<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;


class TextArea extends Input
{
    public function __construct(
        string $name,
        string $id = '',
        public string $label = '',
        public int $cols = 0,
        public int $rows = 0,
        public ?array $summernote = null,
        public string $livewireField = '',
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::text-area');
    }
}
