<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Lang;

class Select extends Input
{

    public string $unselected;
    public iterable $options;
    public string $label;
    public bool $inline;
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
        $selected = '',
        bool $inline = false
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->options = $options;
        $this->label = $label;
        $this->size = $size;
        $this->multiple = $multiple;
        $this->selected = $selected;
        $this->unselected = $unselected;
        $this->inline = $inline;
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

    public static function options_months(bool $sort_from_today = false, string $lang = ''): array
    {
        if (empty($lang)) {
            $options = dot_collect(Lang::get('def-components::strings.months'));
        } else {
            $options = dot_collect(Lang::get('def-components::strings.months', [], $lang));
        }


        if ($sort_from_today) {
            $options = $options->mapWithKeys(fn($label, $index) => ["M$index" => $label]);
            $current_month = today()->format('m') - 1;
            $options = $options->rotate($current_month);
            $options = $options->mapWithKeys(fn($label, $index) => [(string) str($index)->replace('M', '') => $label]);
        }

        return $options->toArray();
    }
}
