<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $label
 */

?>
{{h()->hidden($name)
 ->attributeIf(!$slot->isEmpty(), 'value', $slot)
}}
