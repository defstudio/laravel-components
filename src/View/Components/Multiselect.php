<?php


namespace DefStudio\Components\View\Components;


use DefStudio\Components\Traits\HasName;
use DefStudio\Components\Traits\HasValue;

class Multiselect extends Component
{
    use HasValue;
    use HasName;

    public array $options;
    public string $label;

    public function __construct(string $name, string $label = '', array $options = [], $value = null)
    {
        $this->name = $name;
        $this->options = $options;
        $this->label = $label;
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
