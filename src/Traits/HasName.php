<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\Traits;


trait HasName
{
    use InteractsWithContext;

    public string $name;

    protected function bind_name_prefix($prefix)
    {
        $this->context()->push(['def_name_prefix' => $prefix]);
    }

    public function name(): string
    {
        $prefix = $this->context()->read('def_name_prefix');

        if (empty($prefix)) {
            return $this->name;
        }

        $prefix = $this->array_format_to_arrow_notation($prefix);
        $name = $this->array_format_to_arrow_notation($this->name ?? '');

        $tokenized_name = str("{$prefix}->{$name}")
            ->explode('->')
            ->map(fn($token) => "[$token]")
            ->join('');

        return str($tokenized_name)->replaceFirst('[', '')->replaceFirst(']', '');
    }

    public function dotted_field_name(): string
    {
        return $this->array_format_to_dot_notation($this->name());
    }

    private function array_format_to_dot_notation(string $name): string
    {
        $name = preg_replace('/\[(.+)]/U', '.$1', $name);
        $name = preg_replace('/\[]/U', '', $name);
        return $name;
    }

    private function array_format_to_arrow_notation(string $name): string
    {
        $name = preg_replace('/\[(.+)]/U', '->$1', $name);
        $name = preg_replace('/\[]/U', '', $name);
        return $name;
    }

    public function dashed_field_name(string $default = ''): string
    {
        return $this->array_format_to_dash_notation($this->name() ?? $default);
    }

    private function array_format_to_dash_notation(string $name): string
    {
        return str_replace('.', '_', $this->array_format_to_dot_notation($name));
    }
}
