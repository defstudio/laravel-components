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
   {{number_format((float)$computed_value((string) $slot), $precision, $decimalSeparator, $thousandsSeparator)}}&nbsp;{{$um}}
</span>
