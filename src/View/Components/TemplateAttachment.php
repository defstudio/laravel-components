<?php


namespace DefStudio\Components\View\Components;


class TemplateAttachment extends Input
{

    const METHOD_PUT = 'PUT';
    const METHOD_POST = 'POST';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';


    public string $label;
    public string $color;
    public string $filename;
    public array $columns;
    public string $method;
    public string $url;

    public function __construct(
        string $name,
        array $columns,
        string $url,
        string $id = '',
        string $label = '',
        string $color = 'primary',
        ?string $filename = null,
        string $method = self::METHOD_POST
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->color = $color;
        $this->filename = $filename ?? $this->dashed_field_name();
        $this->columns = $columns;
        $this->method = $method;
        $this->url = $url;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::template-attachment');
    }
}
