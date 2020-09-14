<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $header
 * @var bool $collapsable
 * @var bool $collapsed
 */

$random_id = rand(1, 9999999);

$aria_expanded = $collapsed ? 'false' : 'true'

?>


<div {{$attributes->merge(['class' => 'card', 'id' => "card-{$random_id}"])}}>
    @if(!empty($header))
        <div class="card-header" id="card-header-{{$random_id}}">
            <h5 class="mb-0">
                <span style="cursor: pointer" {{$collapsable?"data-toggle=collapse data-target=#card-body-$random_id aria-expanded=$aria_expanded aria-controls=card-body-$random_id":""}}>
                   {{$header}}
                </span>
            </h5>
        </div>
    @endif

    <div id="card-body-{{$random_id}}" class="{{$collapsable?"collapse":""}} {{$collapsed?"":"show"}}" {{$collapsable?"aria-labelledby=card-header-$random_id":""}}>
        <div class="card-body">
            {{$slot}}
        </div>
    </div>

</div>

