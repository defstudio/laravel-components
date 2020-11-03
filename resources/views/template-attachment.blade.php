<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $label
 */

$default_id = "template-attachment-" . rand(1, 99999999);

?>

<x-button {{$attributes}} data-toggle="modal" data-target="#{{$computed_id($default_id)}}-modal" :color="$color">
    <x-icon name="upload">{{$label??''}}</x-icon>
</x-button>


@push('x-html')
    <x-modal id="{{$computed_id($default_id)}}-modal" class="template-attachment-modal" :title="$label??''" :size="\DefStudio\Components\View\Components\Modal::SIZE_LG">
        <x-form :method="$method" :action="$url" accept-files>
            <div class="row">
                <div class="col-4">
                    <x-button id="{{$computed_id($default_id)}}-download"
                              class="template-attachment-download-button"
                              color="secondary"
                              data-url="{{\Illuminate\Support\Facades\URL::temporarySignedRoute('def-components.download.template', now()->addDay(), ['filename' => $filename])}}"
                              :data-columns="json_encode($columns)"
                    >
                        <x-icon name="download">{{ucwords(__('def-components::files.download_template'))}}</x-icon>
                    </x-button>
                </div>
                <div class="col-7">
                    <x-file :name="$name" accept=".xls"/>
                </div>
                <div class="col-1">
                    <x-button :type="\DefStudio\Components\View\Components\Button::TYPE_SUBMIT" color="success">
                        <x-icon name="upload"/>
                    </x-button>
                </div>
            </div>
        </x-form>
    </x-modal>
@endpush


