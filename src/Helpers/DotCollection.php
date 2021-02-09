<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\Helpers;


use Illuminate\Support\Collection;

/**
 * Class DotCollection
 *
 * @package App\Helpers
 * @mixin Collection
 */
class DotCollection extends Collection
{
    public function get($key, $default = null)
    {
        return data_get($this->items, $key, value($default));
    }
}
