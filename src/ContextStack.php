<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components;


use Illuminate\Support\Arr;

class ContextStack
{
    protected array $stack = [];

    public function push(array $data)
    {
        $this->stack[] = array_merge($this->read(), $data);
    }

    public function read(string $key = null): mixed
    {
        $context = Arr::last($this->stack) ?? [];

        if (empty($key)) {
            return $context;
        }

        return data_get($context, $key);
    }

    public function pop()
    {
        array_pop($this->stack);
    }
}
