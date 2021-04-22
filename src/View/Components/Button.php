<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;


class Button extends Component
{

    public const TYPE_SUBMIT = 'submit';
    public const TYPE_BUTTON = 'button';

    public const METHOD_GET = 'GET';
    public const METHOD_PUT = 'PUT';
    public const METHOD_POST = 'POST';
    public const METHOD_PATCH = 'PATCH';
    public const METHOD_DELETE = 'DELETE';

    public string $href;
    public string $method;

    public function __construct(
        public string $color = 'primary',
        public string $type = self::TYPE_BUTTON,
        public string $confirm = '',
        public string $confirmColor = '',
        public string $icon = '',
        public string $get = '',
        public string $post = '',
        public string $put = '',
        public string $patch = '',
        public string $delete = '',
        public string|null $containerClasses = '',
        public string|bool $wireLoaderSpinner = '',
    ) {
        if (empty($this->confirmColor)) {
            $this->confirmColor = str($this->color)->replace('outline-', '');
        }
        $this->compute_href();
    }

    private function compute_href(): void
    {

        if ($this->get) {
            $this->href = $this->get;
            $this->method = self::METHOD_GET;
        } else if ($this->post) {
            $this->href = $this->post;
            $this->method = self::METHOD_POST;
        } else if ($this->put) {
            $this->href = $this->put;
            $this->method = self::METHOD_PUT;
        } else if ($this->patch) {
            $this->href = $this->patch;
            $this->method = self::METHOD_PATCH;
        } else if ($this->delete) {
            $this->href = $this->delete;
            $this->method = self::METHOD_DELETE;
        } else {
            $this->href = '';
            $this->method = '';
        }
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::button');
    }
}
