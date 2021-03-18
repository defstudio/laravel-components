<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;


use Illuminate\Support\Str;

class Icon extends Component
{

    public function __construct(
        public string $name,
        public string $type = 'fas',
        public string $size = '',
        public bool $spin = false,
    ) {
        if (!Str::startsWith($this->name, 'fa-')) {
            $this->name = "fa-{$this->name}";
        }
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::icon');
    }
}
