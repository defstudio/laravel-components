<?php


namespace DefStudio\Components\View\Components;



class Card extends Component
{
    public string $id;
    public string $icon;
    public string $header;
    public bool $collapsable;
    public bool $collapsed;


    public function __construct(string $id = '', string $header = '', string $icon = '', bool $collapsable = false, bool $collapsed = false)
    {
        $this->id = $id;

        $this->header = $header;
        $this->icon = $icon;

        $this->collapsable = (bool)$collapsable;
        $this->collapsed = (bool)$collapsed;


        if (request()->has('x-card')) {
            if (request()->get('x-card') == $this->id) {
                $this->collapsed = false;
            } else if ($this->collapsable) {
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
