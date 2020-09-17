<?php


namespace DefStudio\Components\View\Components;


use Illuminate\Support\Arr;

class NavbarDropdown extends Component
{

    public string $id;
    public string $label;
    public array $permissions;
    public string $url;

    public function __construct(
        $label = '',
        $id = null,
        $permissions=[],
        $url = '#'
    )
    {
        $this->id = $id??"menu-$label-dropdown";
        $this->label = $label;
        $this->permissions = Arr::wrap($permissions);
        $this->url = $url;
    }


    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::navbar-dropdown');
    }
}
