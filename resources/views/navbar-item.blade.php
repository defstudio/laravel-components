<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 */


if (empty($id)) {
    $id = "menu-" . rand(1, 99999999) . "-dropdown";
}

?>

@if(empty($permission) || \Illuminate\Support\Facades\Gate::any($permission))
    <li {{$attributes
                ->merge(['class' => "nav-item"])
                ->merge(['class' => isset($dropdown)?'dropdown':''])
                }}>
        <a href="{{$url}}"
           role="button"
           id="{{$id}}"
           class="nav-link {{isset($dropdown)?'dropdown-toggle':''}}"
           @isset($dropdown)
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            @endisset
        >
            {{$slot}}
        </a>
        @isset($dropdown)
            <div class="dropdown-menu" aria-labelledby="{{$id}}">
                {{$dropdown}}
            </div>
        @endisset
    </li>
@endif
