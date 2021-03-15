<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 */


?>


<div id="{{$id}}" class="modal fade" role="dialog" {{$backdrop?'':'data-backdrop=static'}}  data-keyboard="{{$keyboard?'true':'false'}}">
    <div {{$attributes->merge(['class' => 'modal-dialog'])
                      ->merge(['class' => $scrollable?'modal-dialog-scrollable':''])
                      ->merge(['class' => empty($size)?'':"modal-$size"])}}
    >
        <div class="modal-content">
            @if(!empty($header))
                <div class="modal-header {{empty($color)?'':"bg-$color"}}">
                    {{$header}}
                </div>
            @elseif(!empty($title))
                <div class="modal-header {{empty($color)?'':"bg-$color"}}">
                    <h4 class="modal-title">{{$title}}</h4>

                    @if($xClose)
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ucwords(__('def-components::modals.close'))}}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    @endif
                </div>
            @endif

            <div class="modal-body">
                {{$slot}}
            </div>

            @unless(empty($footer))
                <div class="modal-footer">
                    {{$footer}}
                </div>
            @endunless
        </div>
    </div>
</div>
