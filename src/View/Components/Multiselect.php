<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;


class Multiselect extends Select
{

    public function __construct(
        string $name,
        string $label = '',
        iterable $options = [],
        iterable $selected = []
    )
    {
        parent::__construct(
            $name,
            $id = '',
            $label,
            $options,
            '',
            true,
            '',
            $selected);
    }


}
