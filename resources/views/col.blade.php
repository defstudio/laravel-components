<?php

use Illuminate\View\ComponentAttributeBag;

/** @var ComponentAttributeBag $attributes */
?>

@props(['size' => null])

<div {{$attributes->merge(['class'=>empty($size)?'col':"col-$size"])}}>
    {{$slot}}
</div>
