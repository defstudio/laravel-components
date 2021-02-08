<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $label
 */

$default_id = "file-selector-" . rand(1, 99999999);
?>


@unless(empty($label))
    <label for="{{$computed_id($default_id)}}">{{$label}}</label>
@endunless

<div id="{{$computed_id($default_id)}}-custom-file_container" class="custom-file ">
    <input
        id="{{$computed_id($default_id)}}"
        type="file"
        name="{{$name()}}"
        {{$attributes->merge(['class' => 'custom-file-input def-components-file-input', 'style' => 'cursor: pointer;'])->merge($error_attributes())}}>

    <label for="{{$computed_id($default_id)}}" class="custom-file-label">{{$browseMessage}}</label>
</div>

