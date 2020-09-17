<?php


namespace DefStudio\Components\View\Components;


use DefStudio\Components\Traits\ChecksErrors;
use DefStudio\Components\Traits\HasId;
use DefStudio\Components\Traits\HasName;
use DefStudio\Components\Traits\HasValue;

abstract class Input extends \Illuminate\View\Component
{
    use HasValue;
    use HasName;
    use HasId;
    use ChecksErrors;
}
