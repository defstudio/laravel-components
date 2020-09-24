<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $href
 * @var string $color
 * @var string $method
 */

$attributes = $attributes->merge(['class' => "btn btn-$color"]);


?>


@empty($href)
    <button type="{{$type}}"
            {{$attributes->merge(['class'=>empty($confirm)?'':'confirmable'])}}
            data-confirm-message="{{$confirm}}"
    >{{$slot}}</button>
@else
    @if($method=='GET')
        <a href="{{$href}}"
           {{$attributes->merge(['class'=>empty($confirm)?'':'confirmable'])}}
           data-confirm-message="{{$confirm}}"
        >{{$slot}}</a>
    @else
        <?php $random_id = rand(1, 9999999); ?>

        @push('x-html')
            <x-form hidden id="button-form-{{$random_id}}" :method="$method" :action="$href"></x-form>
        @endpush

        <button type="submit"
                form="button-form-{{$random_id}}"
                {{$attributes->merge(['class'=>empty($confirm)?'':'confirmable'])}}
                data-confirm-message="{{$confirm}}"
        >{{$slot}}</button>

    @endif
@endempty


@once
@push('x-scripts')
    <script>
        $(document).ready(function () {
            $('a.confirmable,button.confirmable').click(function (evt, confirmed = false) {
                const $button = $(this);
                const message = $button.data('confirm-message');

                if (!confirmed) {
                    evt.preventDefault();

                    tools.confirm.danger('', message).then(confirmed => {
                        if (confirmed) {
                            $button.trigger('click', {confirmed});
                        }
                    });
                }
            });
        });
    </script>
@endpush
@endonce

