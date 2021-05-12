<?php
/** @noinspection PhpUndefinedVariableInspection */

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var HtmlString $slot
 * @var bool $inline
 * @var bool $checked
 *
 */

$radio_id = $computed_id()."-".$original_value();
?>


@if($readonly)
    <input type="hidden" name="{{$name()}}" value="{{$original_value()}}">
@endif

<div class="custom-control {{!empty($label??$slot->isNotEmpty())?'d-flex':''}} {{$custom_class}} {{$containerClass}} {{$inline?'custom-control-inline':''}}">
    <input
        type="radio"
        id="{{$radio_id}}"
        name="{{$name()}}"
        value="{{$original_value()}}"
        {{$attributes->merge(['class' => "custom-control-input"])->merge($error_attributes($errors))}}
        {{$is_checked()?'checked':''}}
        {{$readonly?'disabled':''}}
    />
    <label for="{{$radio_id}}" class="custom-control-label my-auto" style="cursor:pointer;">{{$label??$slot}}</label>
</div>




