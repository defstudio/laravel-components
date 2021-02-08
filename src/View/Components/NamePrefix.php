<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;

class NamePrefix extends Context
{
    public function __construct(public string $val = '')
    {
        parent::__construct(['def_name_prefix' => $val]);
    }
}
