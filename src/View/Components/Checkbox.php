<?php


namespace DefStudio\Components\View\Components;


use DefStudio\Components\Traits\HasId;
use DefStudio\Components\Traits\HasName;
use DefStudio\Components\Traits\HasValue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Checkbox extends Component
{

    use HasName;
    use HasValue;
    use HasId;

    public string $custom_class = 'custom-checkbox';
    private bool $checked;
    public bool $inline;
    public bool $readonly;
    public string $value_unchecked = '';
    public string $value_checked;
    public string $modelField;


    public function __construct(
        string $name,
        $value = '1',
        $checked = false,
        bool $inline = false,
        string $id = '',
        string $modelField = 'id',
        bool $readonly = false
    )
    {
        $this->modelField = $modelField;
        $this->name = $name;
        $this->checked = (bool)$checked;
        $this->inline = $inline;
        $this->readonly = $readonly;
        $this->id = $id;

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

        if ($this->checked) return true;

        $computed_value = $this->computed_value($this->checked);

        if ($computed_value instanceof Collection) {
            return $computed_value->contains($this->modelField, $this->value_checked);
        } else if ($this->is_array()) {
            $computed_values = Arr::wrap($computed_value);

            return in_array($this->value_checked, $computed_values);
        } else {
            return (bool)$computed_value;
        }
    }

    public function is_array(): bool
    {
        return Str::endsWith($this->name ?? '', '[]');
    }


}
