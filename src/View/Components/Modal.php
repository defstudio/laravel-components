<?php


namespace DefStudio\Components\View\Components;

class Modal extends Component
{

    const SIZE_LG = 'lg';
    const SIZE_SM = 'sm';

    public string $id;
    public bool $scrollable;
    public string $size;
    public string $title;

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
        $this->title = $title;
    }


    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::modal');
    }

}
