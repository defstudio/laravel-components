<?php


namespace DefStudio\Components\View\Components;

use Illuminate\Database\Eloquent\Model;

class Form extends Component
{
    public string $method;
    public string $action;
    public bool $accept_files;
    public bool $autocomplete;
    public ?Model $model;

    public function __construct(string $method = 'POST', string $action = '', bool $accept_files = false, $autocomplete = false, Model $model = null)
    {
        $this->method = strtoupper($method);
        $this->action = $action;
        $this->accept_files = $accept_files;
        $this->autocomplete = $autocomplete;

        $this->model = $model;

    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->bind_model($this->model);
        return view('def-components::form');
    }

}
