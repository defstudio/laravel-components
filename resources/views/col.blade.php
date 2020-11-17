<?php

use Illuminate\View\ComponentAttributeBag;

/** @var ComponentAttributeBag $attributes */

/** @var string $size */
?>


<div {{$attributes->merge(['class'=>empty($size)?'col':"col-$size"])}}>
    {{$slot}}
</div>
