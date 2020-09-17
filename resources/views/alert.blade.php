<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $type
 * @var bool $dismissable
 */

$dismissable_class = $dismissable ? 'alert-dismissible' : '';

$attributes = $attributes->merge([
    'class' => "alert alert-$type $dismissable_class fade show"
]);

?>

<div {{$attributes}}>
    {{$slot}}
    @if($dismissable)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    @endif
</div>

