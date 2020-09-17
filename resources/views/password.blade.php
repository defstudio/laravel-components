<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $label
 */

?>

<div {{$attributes->merge(['class' => 'form-group'])}}>

    @unless(empty($label))
        <label for="{{$computed_id()}}">{{$label}}</label>
    @endunless


    <div class="input-group">

        <input
            id="{{$computed_id()}}"
            type="password"
            name="{{$name}}"
            {{$error_attributes()->merge(['class' => 'form-control'])}}
            value="{{$slot}}">

        @isset($append)
            <div class="input-group-append">
                <span class="input-group-text">
                    {{$append}}
                </span>
            </div>
        @endisset
    </div>
</div>
