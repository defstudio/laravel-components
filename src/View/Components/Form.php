<?php


namespace DefStudio\Components\View\Components;

class Form extends Component
{
    public string $method;
    public string $action;
    public bool $acceptFiles;
    public bool $autocomplete;
    public $model;

    public function __construct(string $method = 'POST', string $action = '', bool $acceptFiles = false, $autocomplete = false, $model = null)
    {
        $this->method = strtoupper($method);
        $this->action = $action;
        $this->acceptFiles = $acceptFiles;
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
