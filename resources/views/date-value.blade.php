<?php

use Illuminate\View\ComponentAttributeBag;

/** @var ComponentAttributeBag $attributes */

?>

<span {{$attributes}}>{{carbon($computed_value($slot))?->format($format)}}</span>

