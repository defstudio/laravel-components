<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $type
 */


?>
<span {{$attributes}}>
      @if($wireLoaderSpinner)
        <i wire:loading wire:target="{{$wireLoaderSpinner}}" class="my-auto {{$type}} fa-spinner {{empty($size)?'':"fa-{$size}"}} fa-spin"></i>
        <i wire:loading.remove wire:target="{{$wireLoaderSpinner}}" class="my-auto {{$type}} {{$name}} {{empty($size)?'':"fa-{$size}"}} {{$spin?"fa-spin":''}}"></i>
        <span class="my-auto">{!! $slot->isEmpty()?'':"&nbsp;$slot"!!}</span>
    @else
        <i class="my-auto {{$type}} {{$name}} {{empty($size)?'':"fa-{$size}"}} {{$spin?"fa-spin":''}}"></i><span class="my-auto">{!! $slot->isEmpty()?'':"&nbsp;$slot"!!}</span>
    @endif

</span>
