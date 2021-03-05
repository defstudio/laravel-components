<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;


class Table extends Component
{
    public string $id;
    public iterable $headers;
    public string $datatable;

    public function __construct(string $id = '', iterable $headers = [], string|array $datatable = '')
    {
        $this->id = $id;
        $this->headers = $headers;
        $this->datatable = is_array($datatable) ? json_encode($datatable, JSON_FORCE_OBJECT) : $datatable;

        if (!empty($this->datatable)) {
            if (empty($this->id)) {
                $this->id = "table-".rand(1, 9999999);
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
