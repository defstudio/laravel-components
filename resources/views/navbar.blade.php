<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 */


?>


<nav id="{{$id}}" {{$attributes->merge(['class' => 'navbar'])
                  ->merge(['class' => empty($expand)?'':"navbar-expand-$expand"])
                  ->merge(['class' => "navbar-$theme"])
                  ->merge(['class' => "bt-$bgcolor"])
                  ->merge(['class' => "shadow-sm"])}}>

    @isset($brand)
        <span class="navbar-brand">
            {{$brand}}
        </span>
    @endisset


    @unless(empty($expand))
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#{{$id}}-collapsable" aria-controls="{{$id}}-collapsable" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
    @endunless

    <div id="{{$id}}-collapsable" class="@if(!empty($expand)) collapse navbar-collapse @endif">

        {{$slot}}

    </div>

</nav>
