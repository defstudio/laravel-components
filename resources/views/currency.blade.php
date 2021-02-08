<?php

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $type
 */

/** @var HtmlString $slot */

?>

<span {{$attributes}}>
    {{$currency}}&nbsp;{{number_format((float)$slot->toHtml(), $precision, $decimalSeparator, $thousandsSeparator)}}
</span>
