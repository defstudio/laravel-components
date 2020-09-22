<?php


namespace DefStudio\Components\Traits;


trait HasId
{
    use HasName;

    public string $id = '';

    public function computed_id(string $default = ''): string
    {
        if ($this->id == '') {
            return $this->dashed_field_name($default);
        }
        return $this->id;
    }
}
