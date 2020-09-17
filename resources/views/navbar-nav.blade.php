<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 */


?>

<ul {{$attributes->merge(['class' => 'navbar-nav'])}}>
    {{$slot}}
</ul>
