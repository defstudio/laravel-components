<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $type
 */


?>

<span {{$attributes}}>
    <i class="{{$type}} {{$name}}"></i>{!! $slot->isEmpty()?'':"&nbsp;$slot"!!}
</span>
