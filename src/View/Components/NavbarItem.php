<?php


namespace DefStudio\Components\View\Components;


use Illuminate\Support\Arr;

class NavbarItem extends Component
{

    public string $id;
    public array $permissions;
    public string $url;

    public function __construct(
        $id = '',
        $permissions = [],
        $url = '#'
    )
    {
        $this->id = $id;
        $this->permissions = Arr::wrap($permissions);
        $this->url = $url;
    }


    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::navbar-item');
    }
}
