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

    public function rotate(int $offset = 1): static
    {
        if ($this->isEmpty()) {
            return new static();
        }

        if ($offset == 0) {
            return new static($this);
        }

        $count = $this->count();

        $offset %= $count;

        if ($offset < 0) {
            $offset += $count;
        }

        return new static($this->slice($offset)->merge($this->take($offset)));
    }

    public function next_key($current_key)
    {
        $currentOffset = $this->keys()->search($current_key);

        $next = $this->slice($currentOffset, 2);

        if ($next->count() < 2) {
            return null;
        }

        return $next->keys()->last();
    }


    public function previous_key($current_key)
    {
        return $this->reverse()->next_key($current_key);
    }
}
