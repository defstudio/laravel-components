<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $href
 * @var string $color
 * @var string $method
 */

$attributes = $attributes->merge(['class' => "btn btn-$color"]);


?>


@empty($href)
    <button type="{{$type}}" {{$attributes}}>{{$slot}}</button>
@else
    @if($method=='GET')
        <a href="{{$href}}" {{$attributes}} {!! empty($confirm)?'':"onclick='return confirm(`$confirm`)'" !!}>{{$slot}}</a>
    @else
        <?php $random_id = rand(1, 9999999); ?>
        <x-form hidden id="button-form-{{$random_id}}" :method="$method" :action="$href"></x-form>
        <button type="submit"
                form="button-form-{{$random_id}}"
                {{$attributes}}
                @unless(empty($confirm))
                onclick="return confirm('{{$confirm}}')"
            @endunless
        >{{$slot}}</button>

    @endif
@endempty
