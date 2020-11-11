<?php

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $type
 */

/** @var HtmlString $slot */

?>

<span {{$attributes}}>
    {{$currency}}&nbsp;{{number_format($slot->toHtml(), $precision)}}
</span>
