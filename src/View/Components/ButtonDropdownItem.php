<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;


class ButtonDropdownItem extends Component
{
    public function __construct(
        public string $href
    ) {
    }


    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::button-dropdown-item');
    }
}
