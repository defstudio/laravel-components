<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $label
 */

?>
<div {{$attributes->merge(['class'=>'form-group'])}}>
    {{h()->label($label, $name)}}
    <div class="input-group">
        {{h()->text($name)
         ->class('form-control')
         ->attributeIf(!$slot->isEmpty(), 'value', $slot)
        }}

        @isset($append)
            <div class="input-group-append">
                <span class="input-group-text">
                    {{$append}}
                </span>
            </div>
        @endisset
    </div>

</div>
