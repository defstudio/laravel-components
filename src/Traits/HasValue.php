<?php


namespace DefStudio\Components\Traits;


trait HasValue
{
    use HasName;
    use BindsModels;
    use InteractsWithRequest;

    protected $value;

    public function computed_value($default = '')
    {
        return $this->old_value(
            $this->draft_value(
                $this->model_value(
                    $this->component_value($default)
                )
            )
        );
    }


    public function model_value($default = '')
    {
        $model = $this->model();

        if (empty($model)) return $default;

        return data_get($model, $this->dotted_field_name(), $default);
    }

    public function component_value($default = null)
    {
        return $this->value ?? $default;
    }

}
