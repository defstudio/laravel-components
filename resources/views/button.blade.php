<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $href
 * @var string $color
 * @var string $method
 */

$attributes = $attributes->merge(['class' => "btn btn-$color"]);

if (!empty($confirm)) {
    $attributes->merge([
        'class' => 'confirmable',
        'data-confirm-message', $confirm
    ]);
}
?>


@empty($href)
    <button type="{{$type}}" {{$attributes}}>{{$slot}}</button>
@else
    @if($method=='GET')
        <a href="{{$href}}" {{$attributes}}>{{$slot}}</a>
    @else
        <?php $random_id = rand(1, 9999999); ?>

        @push('x-html')
            <x-form hidden id="button-form-{{$random_id}}" :method="$method" :action="$href"></x-form>
        @endpush

        <button type="submit" form="button-form-{{$random_id}}" {{$attributes}}>{{$slot}}</button>

    @endif
@endempty


@once
    @push('x-scripts')
        <script>
            $(document).on('click', 'a.confirmable,button.confirmable', function (evt, confirmed = false) {
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
    </script>
@endpush
@endonce

