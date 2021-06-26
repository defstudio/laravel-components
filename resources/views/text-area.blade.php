<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $label
 */

?>


@unless(empty($label))
    <label for="{{$computed_id()}}">{{$label}}</label>
@endunless

@if(!empty($livewireField))
    <div wire:ignore wire:key="{{$computed_id()}}_container">
        @endif

        <x-input-group :content-id="$computed_id()" :append="$append ?? null" :prepend="$prepend ?? null">
            <textarea
                {{$attributes
                    ->merge(['class' => 'form-control'])
                    ->merge(['class' => is_null($summernote)||!empty($livewireField)?'':'summernote'])
                    ->merge($error_attributes($errors))}}
                name="{{$name()}}"
                id="{{$computed_id()}}"

                @foreach($summernote??[] as $summernote_feature)
                data-enable-{{$summernote_feature}}="true"
                @endforeach

                @if($cols) cols="{{$cols}}" @endif

                @if($rows) rows="{{$rows}}" @endif

            >{{$computed_value($slot)}}</textarea>
            {{$error_snippet($errors)}}
        </x-input-group>

        @if(!empty($livewireField))
    </div>
@endif


@if(!empty($livewireField))
    @push('x-scripts')
        <script>
            document.addEventListener('livewire:load', function () {
                deftools.summernote.setup_on_element($('#{{$computed_id()}}'), {
                    onChange: function (contents) {
                    @this.set('{{$livewireField}}', contents, true, false);
                    }
                });

            @this.on('set-editor-value', (field, value) => {
                if (field === '{{$livewireField}}') {
                    $('#{{$computed_id()}}').summernote('code', value);
                }
            });
            });
        </script>
    @endpush
@endif
