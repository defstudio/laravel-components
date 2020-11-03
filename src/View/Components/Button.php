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


    public function __construct(
        string $url = '',
        string $route = '',
        string $color = 'primary',
        string $type = self::TYPE_BUTTON,
        string $method = self::METHOD_GET,
        string $confirm = ''
    )
    {
        $this->href = empty($route) ? $url : route($route);
        $this->color = $color;
        $this->type = $type;
        $this->method = $method;
        $this->confirm = $confirm;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::button');
    }
}
