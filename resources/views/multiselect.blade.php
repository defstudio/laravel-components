<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var array $options
 * @var string $label
 */


?>

<div {{$attributes->except('value')->merge(['class' => 'form-group'])}}>
    @unless(empty($label))
        <label for="#{{$dashed_field_name()}}">{{$label}}</label>
    @endunless

    <select name="{{$name}}" id="{{$dashed_field_name()}}" class="form-control multiselect" multiple>
        @foreach($options as $key=>$value)
            <option value="{{$key}}" multiple>{{$value}}</option>
        @endforeach
    </select>
</div>

