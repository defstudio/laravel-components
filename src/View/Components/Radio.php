<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;


use DefStudio\Components\Traits\HasId;
use DefStudio\Components\Traits\HasName;
use DefStudio\Components\Traits\HasValue;

class Radio extends Component
{

    use HasName;
    use HasValue;
    use HasId;

    public string $containerClass;
    public string $custom_class = 'custom-radio';
    public bool $inline;
    public bool $readonly;
    public string $modelField;
    public ?string $label;
    private bool $checked;

    public function __construct(
        string $name,
        string $value,
        string $label = null,
        $checked = false,
        bool $inline = false,
        string $id = '',
        bool $readonly = false,
        string $containerClass = ''
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->checked = (bool) $checked;
        $this->inline = $inline;
        $this->readonly = $readonly;
        $this->id = $id;
        $this->containerClass = $containerClass;
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::radio');
    }

    public function is_checked(): bool
    {
        if ($this->checked) {
            return true;
        }

        $computed_value = $this->computed_value($this->checked);

        return $computed_value == $this->value;
    }
}
