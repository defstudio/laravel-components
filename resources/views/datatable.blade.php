<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string[] $headers
 */


?>

<table {{$attributes->merge(['class' => 'table table-sm table-responsive-md table-hover table-bordered'])}}>
    <thead>
    @isset($header)
        {{$header}}
    @else
        <tr>
            @foreach($headers as $header)
                <th>{{$header}}</th>
            @endforeach
        </tr>
    @endisset
    </thead>
    @isset($slot)
        <tbody>
        {{$slot}}
        </tbody>
    @endisset
    @isset($footer)
        <tfoot>
        {{$footer}}
        </tfoot>
    @endisset
</table>
