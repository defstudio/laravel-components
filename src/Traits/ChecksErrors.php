<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\Traits;


use Illuminate\Support\HtmlString;
use Illuminate\Support\ViewErrorBag;

trait ChecksErrors
{
    use InteractsWithRequest;

    public bool $inlineErrors = true;

    public function error_attributes(ViewErrorBag $blade_errors): array
    {
        $attributes = [];

        if (!$this->has_errors($blade_errors)) {
            return $attributes;
        }


        if ($this->inlineErrors) {
            return [
                'class' => 'is-invalid',
            ];
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

    public function error_snippet(ViewErrorBag $blade_errors)
    {
        if (!$this->inlineErrors) {
            return new HtmlString();
        }

        $errors_html = '';


        foreach ($this->get_errors($blade_errors)->get($this->dotted_field_name()) as $message) {
            $errors_html .= "<div class='invalid-feedback order-last'>$message</div>";
        }


        return new HtmlString($errors_html);
    }

    public function has_errors(ViewErrorBag $blade_errors): bool
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

    public function get_errors(ViewErrorBag $blade_errors): ?ViewErrorBag
    {
        return $blade_errors;
    }
}
