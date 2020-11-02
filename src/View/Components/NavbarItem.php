<?php


namespace DefStudio\Components\View\Components;


use Illuminate\Support\Arr;

class NavbarItem extends Component
{

    public string $id;
    public array $permissions;
    public string $url;
    public string $target;

    public function __construct(
        string $id = '',
        $permissions = [],
        string $url = '#',
        string $target = ''
    )
    {
        $this->id = $id;
        $this->permissions = Arr::wrap($permissions);
        $this->url = $url;
        $this->target = $target;
    }


    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::navbar-item');
    }
}
