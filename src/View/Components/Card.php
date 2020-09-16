<?php


namespace DefStudio\Components\View\Components;



class Card extends Component
{
    public string $header;
    public bool $collapsable;
    public bool $collapsed;


    public function __construct(string $header = '', bool $collapsable = false, bool $collapsed = false)
    {
        $this->header = $header;

        $this->collapsable = (bool)$collapsable;
        $this->collapsed = (bool)$collapsed;

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
