<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $label
 */

?>


<input {{$attributes}} type="hidden" name="{{$name}}" class="form-control" value="{{$computed_value($slot)}}">
