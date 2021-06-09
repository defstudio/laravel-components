<?php


namespace DefStudio\Components\View\Components;


class LivewireUpload extends Component
{
    public function __construct(
        public string $name,
        public string $model,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::livewire-upload');
    }
}
