<?php

use Illuminate\View\ComponentAttributeBag;

/** @var ComponentAttributeBag $attributes */

/** @var string $size */
/** @var bool $flex */
?>


<div {{$attributes
        ->merge(['class'=>empty($size)?'col':"col-$size"])
        ->merge(['class'=>$flex?'d-flex':''])
     }}
>{{$slot}}</div>
