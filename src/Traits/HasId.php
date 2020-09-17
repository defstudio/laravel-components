<?php


namespace DefStudio\Components\Traits;


trait HasId
{
    use HasName;

    public string $id = '';

    public function computed_id(): string
    {
        if ($this->id == '') {
            return $this->dashed_field_name();
        }
        return $this->id ?? '';
    }
}
