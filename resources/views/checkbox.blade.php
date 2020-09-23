<?php
/** @noinspection PhpUndefinedVariableInspection */

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var bool $inline
 * @var bool $checked
 *
 */


$checkbox_id = $computed_id();

if ($is_array()) {
    $checkbox_id = "$checkbox_id-$value_checked";
}

?>


@if($value_unchecked!='')
    <input type="hidden" name="{{$name}}" value="{{$value_unchecked}}">
@endif

<div class="custom-control {{$custom_class}} {{$inline?'custom-control-inline':''}}">
    <input
            type="checkbox"
            id="{{$checkbox_id}}"
            name="{{$name}}"
            value="{{$value_checked}}"
            {{$attributes->merge(['class' => "custom-control-input"])}}
            {{$is_checked()?'checked':''}}
    />
    <label for="{{$checkbox_id}}" class="custom-control-label" style="cursor:pointer;">{{$slot}}</label>
</div>




