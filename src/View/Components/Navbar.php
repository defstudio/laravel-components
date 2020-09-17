<?php


namespace DefStudio\Components\View\Components;


use Illuminate\Support\Str;

class Navbar extends Component
{

    public string $id;
    public ?string $expand;
    public string $theme;
    public string $bgcolor;

    public function __construct(
        string $id = null,
        string $theme = 'light',
        string $expand = 'md',
        string $bgcolor = 'white'
    )
    {
        $this->id = $id??'navbar-'.rand(1000, 9999);
        $this->expand = $expand;
        $this->theme = $theme;
        $this->bgcolor = $bgcolor;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::navbar');
    }
}
