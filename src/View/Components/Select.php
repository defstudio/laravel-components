<?php


namespace DefStudio\Components\View\Components;


use Illuminate\Support\Arr;

class Select extends Input
{

    public string $unselected;
    public iterable $options;
    public string $label;
    public ?string $size;
    public bool $multiple;

    /** @var array|string $selected */
    public $selected;


    public function __construct(
        string $name,
        string $id = '',
        string $label = '',
        iterable $options = [],
        string $size = null,
        bool $multiple = false,
        string $unselected = '',
        $selected = ''
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->options = $options;
        $this->label = $label;
        $this->size = $size;
        $this->multiple = $multiple;
        $this->selected = $selected;
        $this->unselected = $unselected;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::select');
    }

    public function is_selected($option_key): bool
    {
        $selected_values = Arr::wrap($this->computed_value($this->selected));

        return in_array($option_key, $selected_values);
    }
}
