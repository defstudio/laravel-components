<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var iterable $options
 * @var iterable|null|string $value
 */


?>

<div {{$attributes->merge(['class' => 'form-group'])}}>
    {{h()->multiselect($name, $options, $value)->class('form-control')}}
</div>

