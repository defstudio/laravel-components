<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $method
 * @var string $action
 * @var bool $accept_files
 * @var bool $autocomplete
 */

if ($accept_files) {
    $attributes = $attributes->merge([
        'enctype' => 'multipart/form-data'
    ]);
}

if (!$autocomplete) {
    $attributes = $attributes->merge([
        'autocomplete' => 'off'
    ]);
}

?>


<form action="{{$action}}" method="{{$method=='GET'?'GET':'POST'}}" {{$attributes}}>
    @if($method!='GET')
        @csrf
    @endif

    @if(in_array($method, ['DELETE', 'PATCH', 'PUT']))
        <x-def-hidden name="_method">{{$method}}</x-def-hidden>
    @endif

    {{$slot}}

    @php($unbind_model())
</form>
