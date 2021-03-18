<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $type
 */


?>
<span>
    <i class="my-auto {{$type}} {{$name}} {{empty($size)?'':"fa-{$size}"}}"></i><span class="my-auto">{!! $slot->isEmpty()?'':"&nbsp;$slot"!!}</span>
</span>
