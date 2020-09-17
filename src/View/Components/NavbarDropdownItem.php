<?php


namespace DefStudio\Components\View\Components;


use Illuminate\Support\Arr;

class NavbarDropdownItem extends Component
{
    public array $permissions;
    public string $url;

    public function __construct(
        $permissions=[],
        $url = '#'
    )
    {
         $this->permissions = Arr::wrap($permissions);
        $this->url = $url;
    }


    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::navbar-dropdown-item');
    }
}
