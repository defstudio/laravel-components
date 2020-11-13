<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $header
 * @var bool $collapsable
 * @var bool $collapsed
 */

?>


<x-button {{$attributes->merge(['class' => 'apply-zoom btn-xs'])}} :color="$color" :icon="$icon">{{$slot}}</x-button>
