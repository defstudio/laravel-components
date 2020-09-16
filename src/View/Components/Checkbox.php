<?php


namespace DefStudio\Components\View\Components;


use DefStudio\Components\Traits\HasName;
use DefStudio\Components\Traits\HasValue;

class Checkbox extends Component
{

    use HasName;
    use HasValue;

    public $custom_class = 'custom-checkbox';
    private bool $checked;
    public bool $inline;
    public $value_unchecked;
    public $value_checked;


    public function __construct(string $name, $value = '1', ?bool $checked = false, bool $inline = false)
    {
        $this->name = $name;
        $this->checked = (bool)$checked;
        $this->inline = $inline;

        if (is_array($value)) {
            $this->value_unchecked = $value[1];
            $this->value_checked = $value[0];
        } else {
            $this->value_checked = $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::checkbox');
    }

    public function is_checked(): bool
    {


        return $this->checked;
    }
}
