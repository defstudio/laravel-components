<?php

use Illuminate\View\ComponentAttributeBag;

/** @var ComponentAttributeBag $attributes */
/** @var string $name */
/** @var string $model */
?>

<x-row>
    <x-col size="12" wire:loading.remove wire:target="{{$model}}">
        <x-file label="Foto" wire:key="{{$model}}" label="" name="{{$name}}" wire:model="{{$model}}"></x-file>
    </x-col>
    <x-col size="12" wire:loading.flex wire:target="{{$model}}">
        <x-icon class="my-auto" name="spinner" spin>Verifica file...</x-icon>
    </x-col>
</x-row>
