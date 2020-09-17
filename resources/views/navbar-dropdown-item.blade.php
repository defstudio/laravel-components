<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 */


?>

@if(empty($permission) || \Illuminate\Support\Facades\Gate::any($permission))
    <a href="{{$url}}" {{$attributes->merge(['class' => 'dropdown-item'])}}>{{$slot}}</a>
@endif
