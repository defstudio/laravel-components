<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $label
 */

?>


@unless(empty($label))
    <label for="{{$computed_id()}}">{{$label}}</label>
@endunless

<textarea
    {{$attributes
        ->merge(['class' => 'form-control'])
        ->merge(['class' => is_null($summernote)?'':'summernote'])
        ->merge($error_attributes())}}
    name="{{$name()}}"
    id="{{$computed_id()}}"

    @foreach($summernote??[] as $summernote_feature)
    data-enable-{{$summernote_feature}}="true"
    @endforeach

    @if($cols) cols="{{$cols}}" @endif

    @if($rows) rows="{{$rows}}" @endif

    >
        {{$computed_value($slot)}}
    </textarea>
