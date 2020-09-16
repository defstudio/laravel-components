<?php


namespace DefStudio\Components\Traits;


trait HasValue
{
    use HasName;
    use InteractsWithContext;

    protected $value;

    public function computed_value($default = '')
    {
        return $this->value_from_model($default);
    }


    private function value_from_model($default)
    {
        $model = $this->model();

        if (empty($model)) return $default;

        return data_get($model, $this->dotted_field_name(), $default);
    }

}
