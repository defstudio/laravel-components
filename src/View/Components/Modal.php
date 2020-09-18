<?php


namespace DefStudio\Components\View\Components;

class Modal extends Component
{

    public string $id;
    public bool $scrollable;
    public string $size;

    /**
     * Modal constructor.
     * @param string $id
     * @param bool $scrollable
     * @param string $size (optional) allowed values: sm, lg
     * @param string $title (optional)
     */
    public function __construct(
        string $id,
        bool $scrollable = false,
        string $size = '',
        string $title = ''
    )
    {
        $this->id = $id;
        $this->scrollable = $scrollable;
        $this->size = $size;
        $this->size = $title;
    }


    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::modal');
    }

}
