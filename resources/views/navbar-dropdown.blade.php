<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 */


?>

@if(empty($permission) || \Illuminate\Support\Facades\Gate::any($permission))
    <li {{$attributes->merge(['class' => 'nav-item dropdown'])}}>
        <a href="{{$url}}" role="button" id="{{$id}}" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{$label}}
        </a>
        <div class="dropdown-menu" aria-labelledby="{{$id}}">
            {{$slot}}
        </div>
    </li>
@endif
