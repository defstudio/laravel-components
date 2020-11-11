<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $type
 */


?>

<span {{$attributes}}>
    {{$currency}}&nbsp;{{number_format($slot, $precision)}}
</span>
