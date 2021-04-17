<?php


namespace DefStudio\Components\Traits;


use Illuminate\Support\ViewErrorBag;

trait ChecksErrors
{
    use InteractsWithRequest;

    public function error_attributes(ViewErrorBag|null $blade_errors): array
    {
        $attributes = [];

        if (!$this->has_errors($blade_errors)) {
            return $attributes;
        }

        $errors_html = '';

        foreach ($this->get_errors($blade_errors)->get($this->dotted_field_name()) as $message) {
            $errors_html .= "<div>$message</div>";
        }


        $attributes = [
            'class'          => 'is-invalid',
            'data-toggle'    => 'popover',
            'data-trigger'   => 'hover',
            'data-html'      => 'true',
            'data-content'   => $errors_html,
            'data-placement' => 'top',
        ];

        return $attributes;
    }

    public function has_errors(ViewErrorBag|null $blade_errors): bool
    {
        if (empty($this->name)) {
            return false;
        }

        $errors = $this->get_errors($blade_errors);

        if (!empty($errors) && $errors->has($this->dotted_field_name())) {
            return true;
        }

        return false;
    }

    public function get_errors(ViewErrorBag|null $blade_errors): ?ViewErrorBag
    {
        return $blade_errors;
    }
}
