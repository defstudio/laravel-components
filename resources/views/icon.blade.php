<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $type
 */


?>

{{h()->icon($name, $type)->attributes($attributes)}}{!! $slot->isEmpty()?'':"&nbsp;$slot"!!}
