<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $href
 * @var string $color
 * @var string $method
 */

$attributes = $attributes->merge(['class' => "btn btn-$color"]);

?>


@empty($href)
    <button type="{{$type}}" {{$attributes}}>{{$slot}}</button>
@else
    @if($method=='GET')
        <a href="{{$href}}" {{$attributes}} {!! empty($confirm)?'':"onclick='return confirm(`$confirm`)'" !!}>{{$slot}}</a>
    @else
        <x-form :method="$method" :action="$href">
            <button type="submit" {{$attributes}} {!! empty($confirm)?'':"onclick='return confirm(`$confirm`)'" !!}>{{$slot}}</button>
        </x-form>
    @endif
@endempty
