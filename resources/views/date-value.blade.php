<?php

use Illuminate\View\ComponentAttributeBag;

/** @var ComponentAttributeBag $attributes */

?>

<span {{$attributes}}>{{carbon($computed_value((string) $slot))?->format($format)}}</span>

