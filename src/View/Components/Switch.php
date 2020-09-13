<?php


namespace DefStudio\Components\View\Components;


use Illuminate\View\Component;

class CheckboxSwitch extends Component
{
    public ?string $id;
    public string $name;
    public string $label;
    public ?bool $checked;

    /** @var array|string */
    public $value;

    public function __construct(string $name, string $label, $value='1', ?string $id=null, ?bool $checked=null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->id = $id;
        $this->checked = $checked;
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::switch');
    }
}
