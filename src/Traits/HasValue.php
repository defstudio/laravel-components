<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\Traits;


trait HasValue
{
    use HasName;
    use BindsModels;
    use InteractsWithRequest;

    protected $value;

    public function original_value(): string
    {
        return $this->value;
    }

    public function computed_value(
        $default = ''
    ) {
        return $this->old_value(
            $this->draft_value(
                $this->model_value(
                    $this->component_value($default)
                )
            )
        );
    }


    public function model_value(
        $default = ''
    ) {
        $model = $this->model();

        if (empty($model)) {
            return $default;
        }

        return data_get($model, $this->dotted_field_name(), $default);
    }

    public function component_value(
        $default = null
    ) {
        return $this->value ?? $default;
    }

}
