<?php

namespace DefStudio\Components\View\Components;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DateBox extends Component
{
    public function __construct(
        public Carbon $date
    )
    {
    }

    public function render(): View|Factory|Htmlable|Closure|string|Application
    {
        return view('def-components::date-box');
    }
}
