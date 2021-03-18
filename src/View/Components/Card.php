<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;



class Card extends Component
{
    public bool $collapsable;
    public bool $collapsed;
    public bool $active;


    public function __construct(
        public string $id = '',
        public string $header = '',
        public string $rightHeader = '',
        public string $icon = '',
        public string|null $color = null,
        public string|null $borderColor = null,
        bool $active = true,
        bool $collapsable = false,
        bool $collapsed = false
    ) {

        $this->active = (bool) $active;
        $this->collapsable = (bool) $collapsable;
        $this->collapsed = (bool) $collapsed;


        if (request()->has('x-card')) {
            if (request()->get('x-card') == $this->id) {
                $this->collapsed = false;
            } elseif ($this->collapsable) {
                $this->collapsed = true;
            }


        }

        if ($this->collapsed) {
            $this->collapsable = true;
        }
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::card');
    }
}
