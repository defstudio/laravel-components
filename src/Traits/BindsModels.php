<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\Traits;


use Illuminate\Database\Eloquent\Model;

trait BindsModels
{
    use InteractsWithContext;

    public function bind_model(?Model $model)
    {
        $this->context()->push(['model' => $model]);
    }

    public function unbind_model()
    {
        $this->context()->pop();
    }

    public function model(): ?Model
    {
        return $this->context()->read('model');
    }
}
