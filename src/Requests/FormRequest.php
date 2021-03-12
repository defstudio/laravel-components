<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\Requests;


class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function validated(string $key = null, mixed $default = null)
    {
        return data_get(parent::validated(), $key, $default);
    }

    protected function getRedirectUrl()
    {
        if ($this->has('_back')) {
            session()->flash('_back', $this->get('_back'));
        }

        return parent::getRedirectUrl();
    }
}
