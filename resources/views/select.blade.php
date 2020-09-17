<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var array $options
 * @var string $label
 * @var string|null $size
 */


?>

<div {{$attributes->merge(['class' => 'form-group'])}}>
    @unless(empty($label))
        <label for="{{$computed_id()}}">{{$label}}</label>
    @endunless

    <select
        name="{{$name}}"
        id="{{$computed_id()}}"
        {{$error_attributes()->merge(['class' => 'form-control custom-select' . empty($size)?'':"-$size"])}}
        {{$multiple?'multiple':''}}>

        @foreach($options as $key=>$value)
            <option value="{{$key}}" {{$is_selected($key)?'selected':''}}>{{$value}}</option>
        @endforeach

    </select>
</div>

