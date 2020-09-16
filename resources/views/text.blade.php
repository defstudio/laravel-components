<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $label
 */

?>
<div {{$attributes->merge(['class'=>'form-group'])}}>

    @unless(empty($label))
        <label for="#{{$dashed_field_name()}}">{{$label}}</label>
    @endunless


    <div class="input-group">

        <input id="{{$dashed_field_name()}}" type="text" name="{{$name}}" class="form-control" value="{{$computed_value($slot)}}">

        @isset($append)
            <div class="input-group-append">
                <span class="input-group-text">
                    {{$append}}
                </span>
            </div>
        @endisset
    </div>
</div>
