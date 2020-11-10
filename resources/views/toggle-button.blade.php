<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $color
 * @var string $method
 */

?>

<x-button :color="$color" {{$attributes}} data-toggle="collapse" data-target="{{$target}}">{{$slot}}</x-button>
