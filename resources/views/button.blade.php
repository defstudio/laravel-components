<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $href
 * @var string $color
 * @var string $confirmColor
 * @var string $method
 * @var string|bool $wireLoaderSpinner
 */

$attributes = $attributes->merge(['class' => "btn btn-$color"]);

if (!empty($confirm)) {
    $attributes = $attributes->merge([
        'class'                => "confirmable confirmable-{$confirmColor}",
        'data-confirm-message' => $confirm,
    ]);
}


if ($wireLoaderSpinner === true) {
    $wireLoaderSpinner = $attributes->get('wire:click', '');
}


?>

@if(!empty($dropdown))
    @php($id = $attributes->get('id', 'button-'.\Illuminate\Support\Str::random()))
    <div class="dropdown {{$containerClasses}}">
        <button type="button"
                {{$attributes->merge(['class' => 'dropdown-toggle', 'id' => $id])}}
                data-toggle="dropdown"
                aria-haspopup="true"
        >
            @empty($icon)
                @if($wireLoaderSpinner)
                    <i wire:loading @if($wireLoaderSpinner!='all') wire:target="{{$wireLoaderSpinner}}" @endif class="my-auto fa-spinner fa-spin"></i>
                @endif
                {{$slot}}
            @else
                <x-icon name="{{$icon}}" :wireLoaderSpinner="$wireLoaderSpinner">{{$slot}}</x-icon>
            @endempty
        </button>
        <div class="dropdown-menu" aria-labelledby="{{$id}}">
            {{$dropdown}}
        </div>
    </div>
@else

    @empty($href)
        <button type="{{$type}}" {{$attributes}}>
            @empty($icon)
                @if($wireLoaderSpinner)
                    <i wire:loading @if($wireLoaderSpinner!='all') wire:target="{{$wireLoaderSpinner}}" @endif class="fas my-auto fa-spinner fa-spin"></i>
                @endif
                {{$slot}}
            @else
                <x-icon name="{{$icon}}" :wireLoaderSpinner="$wireLoaderSpinner">{{$slot}}</x-icon>
            @endempty
        </button>
    @else
        @if($method=='GET')
            <a href="{{$href}}" {{$attributes}}>
                @empty($icon)
                    @if($wireLoaderSpinner)
                        <i wire:loading @if($wireLoaderSpinner!='all') wire:target="{{$wireLoaderSpinner}}" @endif class="my-auto fa-spinner fa-spin"></i>
                    @endif
                    {{$slot}}
                @else
                    <x-icon name="{{$icon}}" :wireLoaderSpinner="$wireLoaderSpinner">{{$slot}}</x-icon>
                @endempty
            </a>
        @else
            <?php $random_id = rand(1, 9999999); ?>

            @push('x-html')
                <x-form hidden id="button-form-{{$random_id}}" :method="$method" :action="$href"></x-form>
            @endpush

            <button type="submit" form="button-form-{{$random_id}}" {{$attributes->merge(['class' => empty($confirm)?'':'force-confirm'])}}>
                @empty($icon)
                    @if($wireLoaderSpinner)
                        <i wire:loading @if($wireLoaderSpinner!='all') wire:target="{{$wireLoaderSpinner}}" @endif class="my-auto fa-spinner fa-spin"></i>
                    @endif
                    {{$slot}}
                @else
                    <x-icon name="{{$icon}}" :wireLoaderSpinner="$wireLoaderSpinner">{{$slot}}</x-icon>
                @endempty
            </button>

        @endif
    @endempty
@endif
