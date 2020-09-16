<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var bool $inline
 * @var bool $checked
 *
 */


?>

@if($inline)
    @if(isset($value_unchecked))
        <input type="hidden" name="{{$name}}" value="{{$value_unchecked}}">
    @endif

    <div class="custom-control {{$custom_class}} custom-control-inline">
        <input type="checkbox" id="{{$dashed_field_name()}}-{{$value_checked}}" name="{{$name}}" value="{{$value_checked}}" class="custom-control-input" {{$is_checked()}} />
        <label for="#{{$dashed_field_name()}}-{{$value_checked}}" class="custom-control-label">{{$slot}}</label>
    </div>
@else
    <div {{$attributes->merge(['class' => 'form-group'])}}>
        @if(isset($value_unchecked))
            <input type="hidden" name="{{$name}}" value="{{$value_unchecked}}">
        @endif
        <div class="custom-control {{$custom_class}} custom-control-inline">
            <input type="checkbox" id="{{$dashed_field_name()}}-{{$value_checked}}" name="{{$name}}" value="{{$value_checked}}" class="custom-control-input" {{$is_checked()}} />
            <label for="#{{$dashed_field_name()}}-{{$value_checked}}" class="custom-control-label">{{$slot}}</label>
        </div>
    </div>
@endif



