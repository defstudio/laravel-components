<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\View\Components;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class DateBox extends Component
{
    public function __construct(
        public Carbon $date
    ) {
    }

    public function render(): View
    {
        return view('def-components::date-box');
    }
}
