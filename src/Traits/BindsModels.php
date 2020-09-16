<?php


namespace DefStudio\Components\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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
        return Arr::get($this->context()->read(), 'model');
    }
}
