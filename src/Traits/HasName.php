<?php


namespace DefStudio\Components\Traits;


trait HasName
{
    public string $name;

    public function dotted_field_name(): string
    {
        return $this->array_format_to_dot_notation($this->name ?? '');
    }

    private function array_format_to_dot_notation($name)
    {
        $name = preg_replace('/\[(.+)]/U', '.$1', $name);
        $name = preg_replace('/\[]/U', '', $name);
        return $name;
    }

    public function dashed_field_name(string $default = ''): string
    {
        return $this->array_format_to_dash_notation($this->name ?? $default);
    }

    private function array_format_to_dash_notation($name)
    {
        return str_replace('.', '_', $this->array_format_to_dot_notation($name));
    }
}
