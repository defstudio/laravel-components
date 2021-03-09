<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;


class File extends Input
{


    public function __construct(
        string $name,
        string $id = '',
        public string $label = '',
        public string $browseMessage = '',
        public bool $pdf = false,
        public bool $xlsx = false,
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::file');
    }
}
