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

$borderColor = $attributes->get('invalid', '') == 'invalid' ? 'danger' : $borderColor;

$attributes = $attributes
    ->merge(['class' => 'card', 'id' => $id])
    ->merge(['class' => empty($borderColor) ? '' : "border-$borderColor"])

?>


<div {{$attributes}}>
    @if(!empty($header))
        <div class="card-header {{empty($color)?'':"bg-$color"}} {{$active?'':'text-secondary'}}" id="card-header-{{$id}}">
            <h5 class="mb-0">
                <span class="d-flex {{$collapsed?'collapsed':''}}"
                      style="cursor: pointer"
                        {{($active&&$collapsable)?"data-toggle=collapse data-target=#card-body-$id aria-expanded=$aria_expanded aria-controls=card-body-$id":""}}>

                    @empty($icon)
                        {{$header}}
                    @else
                        <x-icon :name="$icon">{{$header}}</x-icon>
                    @endempty

                      <div class="ml-auto d-flex">
                          {{$rightHeader}}

                          @if($active && $collapsable)
                              <x-icon class="toggle-collapse ml-3" name="angle-double-down"/>
                          @endif
                      </div>
                </span>
            </h5>
        </div>
    @endif

    <div id="card-body-{{$id}}"
         style="height: 100%"
         class="{{$collapsable?"collapse":""}} {{$collapsed?"":"show"}}"
        {{$collapsable?"aria-labelledby=card-header-$id":""}}>
        <div class="card-body {{$cardBodyClass}}" style="height: 100%">
            {{$slot}}
        </div>
    </div>
</div>

