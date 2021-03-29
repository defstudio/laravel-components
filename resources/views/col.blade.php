<?php

use Illuminate\View\ComponentAttributeBag;

/** @var ComponentAttributeBag $attributes */

/** @var string $size */
/** @var bool $flex */

if (empty($size)) {
    $size = "col";
} else {
    $size = str($size)->split(' ')
        ->map(fn(string $col_size) => "col-$col_size")
        ->join(' ');

}

?>


<div {{$attributes
        ->merge(['class'=> $size])
        ->merge(['class'=>$flex?'d-flex':''])
     }}
>{{$slot}}</div>
