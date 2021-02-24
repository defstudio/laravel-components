<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $type
 */


?>

<fieldset {{$attributes->merge(['class' => 'border p-2'])}}>
    <legend class="w-auto" style="font-size: 1rem">{{$name}}</legend>

    {{$slot}}
</fieldset>
