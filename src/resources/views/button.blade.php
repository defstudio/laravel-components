<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $href
 * @var string $color
 * @var string $color
 */


?>


@empty($href)
    <button type="{{$type}}" {{$attributes->merge(['class' => "btn btn-$color"])}}>{{$slot}}</button>
@else
    <a href="{{$href}}" {{$attributes}}>{{$slot}}</a>
@endempty
