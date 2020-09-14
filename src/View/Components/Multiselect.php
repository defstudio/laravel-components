<?php


namespace DefStudio\Components\View\Components;


use Illuminate\View\Component;

class Multiselect extends Component
{
    public string $name;
    public $options;
    public $value;

    public function __construct(string $name, $options = [], $value = null)
    {
        $this->name = $name;
        $this->options = $options;
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::multiselect');
    }
}
