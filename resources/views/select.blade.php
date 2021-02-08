<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var array $options
 * @var string $label
 * @var string|null $size
 */


?>


@unless(empty($label))
    <label for="{{$computed_id()}}">{{$label}}</label>
@endunless

<select
    name="{{$name()}}"
    id="{{$computed_id()}}"
    {{$attributes->merge(['class' => 'form-control'])
                 ->merge(['class' => 'custom-select' . (empty($size)?'':"-$size")])
                 ->merge($error_attributes())}}
    {{$multiple?'multiple':''}}>

    @if(!empty($unselected))
        <option value="">{{$unselected}}</option>
    @endif

    @foreach($options as $key=>$value)
        <option value="{{$key}}" {{$is_selected($key)?'selected':''}}>{{$value}}</option>
    @endforeach

</select>

