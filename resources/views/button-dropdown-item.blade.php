<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $href
 * @var string $color
 * @var string $confirmColor
 * @var string $method
 */

?>


<a {{$attributes->merge(['class' => 'dropdown-item'])}} href="{{$href}}">{{$slot}}</a>
