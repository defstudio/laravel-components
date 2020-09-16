<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $type
 */


?>

<i {{$attributes->merge(['class' => "$type $name"])}}>
    {!! $slot->isEmpty()?'':"&nbsp;$slot"!!}
</i>
