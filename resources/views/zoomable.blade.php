<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $header
 * @var bool $collapsable
 * @var bool $collapsed
 */

?>


<div {{$attributes->merge(['class' => 'zoomable d-flex'])}}>

    @empty($zoom_button)
        <x-zoom-button>Zoom</x-zoom-button>
    @else
        {{$zoom_button}}
    @endempty

    {{$slot}}
</div>

