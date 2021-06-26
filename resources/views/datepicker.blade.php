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


<x-input-group :content-id="$computed_id()" :append="$append ?? null" :prepend="$prepend ?? null">
    <input
        id="{{$computed_id()}}"
        type="date"
        name="{{$name()}}"
        {{$attributes->merge(['class' => 'form-control'])
                     ->merge(['autocomplete' => 'nope'])
                     ->merge($error_attributes($errors))}}
        value="{{carbon($computed_value((string)$slot))?->format('Y-m-d')}}">
    {{$error_snippet($errors)}}
</x-input-group>

