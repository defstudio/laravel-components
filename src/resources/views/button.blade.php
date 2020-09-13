<?php




$attributes = )
?>

@empty($href)
    <button type="{{$type}}" {{$attributes->merge(['class' => "btn btn-$color"]}}>{{$slot}}</button>
@else
    <a href="{{$href}}" {{$attributes}}>{{$slot}}</a>
@endempty
