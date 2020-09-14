<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $id
 * @var string $value
 * @var bool $checked
 *
 */
?>

<div class="form-group">
    @if(is_array($value))
        <input type="hidden" name="{{$name}}" value="{{$value[1]}}">
       <?php $value=$value[0] ?>
    @endif
    {{h()->custom_checkbox($name, $slot, $checked, $value, $id)}}
</div>
