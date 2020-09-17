<?php


namespace DefStudio\Components\Traits;


use Illuminate\Support\ViewErrorBag;
use Illuminate\View\ComponentAttributeBag;

trait ChecksErrors
{
    use InteractsWithRequest;

    public function error_attributes(): ComponentAttributeBag
    {
        $attributes = new ComponentAttributeBag();

        if (!$this->has_errors()) return $attributes;

        $errors_html = '';

        foreach ($this->get_errors()->get($this->dotted_field_name()) as $message) {
            $errors_html .= "<div>$message</div>";
        }


        $attributes->setAttributes([
            'class' => 'is-invalid',
            'data-toggle' => 'popover',
            'data-trigger' => 'hover',
            'data-html' => 'true',
            'data-content' => $errors_html,
            'data-placement' => 'top',
        ]);

        return $attributes;
    }

    public function has_errors(): bool
    {
        if (empty($this->name)) return false;

        $errors = $this->get_errors();

        if (!empty($errors) && $errors->has($this->dotted_field_name())) {
            return true;
        }

        return false;
    }

    public function get_errors(): ?ViewErrorBag
    {
        return $this->session()->get('errors');
    }
}
