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
            type="password"
            name="{{$name()}}"
            {{$attributes->merge(['class' => 'form-control'])
                         ->merge(['autocomplete' => 'new-password'])
                         ->merge($error_attributes($errors))}}
            value="{{$slot}}">
        {{$error_snippet($errors)}}
</x-input-group>
