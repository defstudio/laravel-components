<?php

use Illuminate\View\ComponentAttributeBag;

/** @var ComponentAttributeBag $attributes */

?>

@if($html)
    <span {{$attributes}}>{!! $computed_value($slot) !!}</span>
@else
    <span {{$attributes}}>{{$computed_value($slot)}}</span>
@endif

