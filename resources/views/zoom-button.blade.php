<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $header
 * @var bool $collapsable
 * @var bool $collapsed
 */

?>

<div class="row mb-3">
    <div class="col-12 d-flex">
        <x-button {{$attributes->merge(['class' => 'apply-zoom btn-xs'])}} :color="$color" :icon="$icon"/>
    </div>
</div>

