<?php


namespace DefStudio\Components\View\Components;


use Illuminate\Support\Str;

class Icon extends Component
{
    public string $name;
    public string $type;

    public function __construct(string $name, string $type='fas')
    {
        $this->name = $name;
        $this->type = $type;

        if (!Str::startsWith($this->name, 'fa-')) {
            $this->name = "fa-{$this->name}";
        }
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::icon');
    }
}
