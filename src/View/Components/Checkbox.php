<?php


namespace DefStudio\Components\View\Components;


use Illuminate\View\Component;

class Checkbox extends Component
{
    public ?string $id;
    public string $name;
    public ?bool $checked;
    public bool $inline;

    /** @var array|string */
    public $value;

    public function __construct(string $name, $value = '1', ?string $id = null, ?bool $checked = null, bool $inline = false)
    {
        $this->name = $name;
        $this->id = $id;
        $this->checked = $checked;
        $this->value = $value;
        $this->inline = $inline;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::checkbox');
    }
}
