<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 */


?>
@if(empty($permissions) || \Illuminate\Support\Facades\Gate::any($permissions))
    <a href="{{$url}}" {{$attributes->merge(['class' => 'dropdown-item'])}}>{{$slot}}</a>
@endif
