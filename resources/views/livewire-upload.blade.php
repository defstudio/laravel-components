<?php

use Illuminate\View\ComponentAttributeBag;

/** @var ComponentAttributeBag $attributes */
/** @var string $name */
/** @var string $key */
?>

<x-row>
    @if(!$uploadedFile)
        <x-col size="12" wire:loading.remove wire:target="{{$key}}">
            <x-file label="Foto" wire:key="{{$key}}" label="" name="{{$name}}" wire:model="{{$key}}"></x-file>
        </x-col>
        <x-col size="12" wire:loading.flex wire:target="{{$key}}">
            <x-icon class="my-auto" name="spinner" spin>Verifica file...</x-icon>
        </x-col>
    @else
        <x-col size="12">
            {{$slot->isEmpty()?"File pronto per l'invio":$slot}}
        </x-col>
    @endif
</x-row>
