<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $type
 */


?>

<span {{$attributes}}>
    <i class="{{$type}} {{$name}} {{empty($size?'':"fa.$size")}}"></i>{!! $slot->isEmpty()?'':"&nbsp;$slot"!!}
</span>
