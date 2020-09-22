<?php
/** @noinspection PhpUndefinedVariableInspection */

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $method
 * @var string $action
 * @var bool $accept_files
 * @var bool $autocomplete
 */

if ($acceptFiles) {
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
        <input type="hidden" name="_method" value="{{$method}}">
    @endif

    {{$slot}}

    <?php $unbind_model() ?>
</form>
