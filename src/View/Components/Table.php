<?php


namespace DefStudio\Components\View\Components;


class Table extends Component
{
    public string $id;
    public array $headers;
    public string $datatable;

    public function __construct(string $id = '', array $headers = [], string $datatable = '')
    {
        $this->id = $id;
        $this->headers = $headers;
        $this->datatable = $datatable;

        if (!empty($this->datatable)) {
            if (empty($this->id)) {
                $this->id = "table-" . rand(1, 9999999);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::table');
    }
}
