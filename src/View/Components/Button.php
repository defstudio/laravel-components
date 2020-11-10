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
    public string $get;
    public string $post;
    public string $put;
    public string $patch;
    public string $delete;

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
        $this->color = $color;
        $this->type = $type;
        $this->confirm = $confirm;

        $this->icon = $icon;

        $this->get = $get;
        $this->post = $post;
        $this->put = $put;
        $this->patch = $patch;
        $this->delete = $delete;

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
