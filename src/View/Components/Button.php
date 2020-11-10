<?php


namespace DefStudio\Components\View\Components;


class Button extends Component
{

    const TYPE_SUBMIT = 'submit';
    const TYPE_BUTTON = 'button';

    const METHOD_GET = 'GET';
    const METHOD_PUT = 'PUT';
    const METHOD_POST = 'POST';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';

    public string $href;
    public string $color;
    public string $type;
    public string $method;
    public string $confirm;
    public string $icon;

    public function __construct(
        string $color = 'primary',
        string $type = self::TYPE_BUTTON,
        string $confirm = '',
        string $icon = '',
        string $get = '',
        string $post = '',
        string $put = '',
        string $patch = '',
        string $delete = ''
    )
    {
        $this->compute_href($get, $post, $put, $patch, $delete);

        $this->color = $color;
        $this->type = $type;
        $this->confirm = $confirm;

        $this->icon = $icon;

    }

    private function compute_href(string $get, string $post, string $put, string $patch, string $delete): void
    {

        if ($get) {
            $this->href = $get;
            $this->method = self::METHOD_GET;
        } else if ($post) {
            $this->href = $post;
            $this->method = self::METHOD_POST;
        } else if ($put) {
            $this->href = $put;
            $this->method = self::METHOD_PUT;
        } else if ($patch) {
            $this->href = $patch;
            $this->method = self::METHOD_PATCH;
        } else if ($delete) {
            $this->href = $delete;
            $this->method = self::METHOD_DELETE;
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
