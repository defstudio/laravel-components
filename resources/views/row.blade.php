<?php

use Illuminate\View\ComponentAttributeBag;

/** @var ComponentAttributeBag $attributes */
?>


<div {{$attributes->merge(['class'=>'row'])}}>
    {{$slot}}
</div>
