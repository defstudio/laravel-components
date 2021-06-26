<?php


namespace DefStudio\Components\View\Components;


use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;

class InputGroup extends Component
{
    public function __construct(
        public string $contentId,
        public string|HtmlString|null $append,
        public string|HtmlString|null $prepend,
    )
    {
    }

    public function render(): View
    {
        return view('def-components::input-group');
    }
}
