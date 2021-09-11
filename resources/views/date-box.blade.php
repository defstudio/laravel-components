<?php

use Illuminate\View\ComponentAttributeBag;

/** @var ComponentAttributeBag $attributes */

?>

<div {{$attributes->merge(['class' => 'def-components-date-box'])}}>
    <div class="def-components-month-box">{{carbon($date)->shortMonthName}}</div>
    <div class="def-components-day-box mt-1">{{carbon($date)->day}}</div>
    <div class="def-components-year-box">{{carbon($date)->year}}</div>
</div>
