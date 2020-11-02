<?php

use Illuminate\View\ComponentAttributeBag;

/**
 * @var ComponentAttributeBag $attributes
 * @var string $name
 * @var string $label
 */

$default_id = "template-attachment-" . rand(1, 99999999);

?>

<x-toggle-button {{$attributes}} target="#{{$computed_id($default_id)}}-container" :color="$color">
    <x-icon name="upload">{{$label??''}}</x-icon>
</x-toggle-button>

<br>

<x-card id="{{$computed_id($default_id)}}-container" collapsed>
    <div class="row">
        <div class="col-4">
            <x-button id="{{$computed_id($default_id)}}-download"
                      color="secondary"
                      data-url="{{\Illuminate\Support\Facades\URL::temporarySignedRoute('def-components.download.template', now()->addDay(), ['filename' => $filename])}}"
            >
                <x-icon name="download">{{ucwords(__('def-components::files.download_template'))}}</x-icon>
            </x-button>
        </div>
    </div>
</x-card>


@push('x-scripts')
    <script type="text/javascript">
        $("#{{$computed_id($default_id)}}-download").on("click", function () {
            const fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endpush


