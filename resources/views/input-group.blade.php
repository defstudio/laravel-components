@if(empty($append))
    {{$slot}}
@else
    <div id="{{$contentId}}-input-group" class="input-group">

        @if(!empty($prepend))
            <div class="input-group-prepend">
                @if(str($prepend)->contains('button') && str($prepend)->contains('<'))
                    {{$prepend}}
                @else
                    <span class="input-group-text">
                        {{$prepend}}
                    </span>
                @endif
            </div>
        @endif

        {{$slot}}

        @if(!empty($append))
            <div class="input-group-append">
                @if(str($append)->contains('button') && str($append)->contains('<'))
                    {{$append}}
                @else
                    <span class="input-group-text">
                        {{$append}}
                    </span>
                @endif
            </div>
        @endif
    </div>
@endif
