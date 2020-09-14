<?php


namespace DefStudio\Components\View\Components;


use Illuminate\View\Component;

class Checkbox extends Component
{
    public ?string $id;
    public string $name;
    public ?bool $checked;

    /** @var array|string */
    public $value;

    public function __construct(string $name, $value = '1', ?string $id = null, ?bool $checked = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->checked = $checked;
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::checkbox');
    }
}
