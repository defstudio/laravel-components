<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $href
 * @var string $color
 * @var string $color
 */

$attributes = $attributes->merge(['class' => "btn btn-$color"]);

?>


@empty($href)
    <button type="{{$type}}" {{$attributes}}>{{$slot}}</button>
@else
    <a href="{{$href}}" {{$attributes}}>{{$slot}}</a>
@endempty
