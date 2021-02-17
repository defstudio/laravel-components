<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $label
 */

?>


@unless(empty($label))
    <label for="{{$computed_id()}}">{{$label}}</label>
@endunless

<div id="{{$computed_id()}}-input-group" class="input-group">

    <input
        id="{{$computed_id()}}"
        type="date"
        name="{{$name()}}"
        {{$attributes->merge(['class' => 'form-control'])
                     ->merge(['autocomplete' => 'nope'])
                     ->merge($error_attributes())}}
        value="{{carbon($computed_value($slot))?->format('Y-m-d')}}">

    @isset($append)
        <div class="input-group-append">
        <span class="input-group-text">
            {{$append}}
        </span>
        </div>
    @endisset

</div>

