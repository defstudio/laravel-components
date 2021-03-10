<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $header
 * @var bool $collapsable
 * @var bool $collapsed
 */

if (empty($id)) {
    $id = "card-".rand(1, 9999999);
}


$aria_expanded = $collapsed ? 'false' : 'true';

?>


<div {{$attributes->merge(['class' => 'card', 'id' => $id])
                  ->merge(['class' => $attributes->get('invalid','')=='invalid'?'border-danger':''])}}>
    @if(!empty($header))
        <div class="card-header" id="card-header-{{$id}}">
            <h5 class="mb-0">
                <span class="d-flex {{$collapsed?'collapsed':''}}" style="cursor: pointer"
                    {{$collapsable?"data-toggle=collapse data-target=#card-body-$id aria-expanded=$aria_expanded aria-controls=card-body-$id":""}}>
                    @empty($icon)
                        {{$header}}
                    @else
                        <x-icon :name="$icon">{{$header}}</x-icon>
                    @endempty


                    @if($collapsable)
                        <x-icon class="toggle-collapse ml-auto" name="angle-double-down"/>
                    @endif
                </span>
            </h5>
        </div>
    @endif

    <div id="card-body-{{$id}}" class="{{$collapsable?"collapse":""}} {{$collapsed?"":"show"}}" {{$collapsable?"aria-labelledby=card-header-$id":""}}>
        <div class="card-body">
            {{$slot}}
        </div>
    </div>

</div>

