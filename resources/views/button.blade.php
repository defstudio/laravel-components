<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $href
 * @var string $color
 * @var string $method
 */

$attributes = $attributes->merge(['class' => "btn btn-$color"]);

if (!empty($confirm)) {
    $attributes = $attributes->merge([
        'class' => 'confirmable',
        'data-confirm-message' => $confirm,
    ]);
}
?>


@empty($href)
    <button type="{{$type}}" {{$attributes}}>
        @empty($icon)
            {{$slot}}
        @else
            <x-icon name="{{$icon}}">{{$slot}}</x-icon>
        @endempty
    </button>
@else
    @if($method=='GET')
        <a href="{{$href}}" {{$attributes}}>
            @empty($icon)
                {{$slot}}
            @else
                <x-icon name="{{$icon}}">{{$slot}}</x-icon>
            @endempty
        </a>
    @else
        <?php $random_id = rand(1, 9999999); ?>

        @push('x-html')
            <x-form hidden id="button-form-{{$random_id}}" :method="$method" :action="$href"></x-form>
        @endpush

        <button type="submit" form="button-form-{{$random_id}}" {{$attributes}}>
            @empty($icon)
                {{$slot}}
            @else
                <x-icon name="{{$icon}}">{{$slot}}</x-icon>
            @endempty
        </button>

    @endif
@endempty
