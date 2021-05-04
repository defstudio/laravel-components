<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;

class Modal extends Component
{

    public const SIZE_LG = 'lg';
    public const SIZE_SM = 'sm';

    public function __construct(
        public string $id,
        public bool $scrollable = false,
        public string $size = '',
        public string $title = '',
        public string $color = '',
        public string $header = '',
        public bool $show = false,
        public bool $backdrop = true,
        public bool $keyboard = true,
        public bool $xClose = true,
        public bool $livewireDialog = false,
    ) {
    }


    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::modal');
    }

}
