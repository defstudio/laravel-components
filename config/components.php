<?php

return [

    /*
     * Set the tag prefix to assign to the package
     * i.e. 'tag_prefix' => 'defstudio'
     * will result in a component named <x-defstudio-text></x-defstudio-text>
     */
    'tags_prefix' => '',

    'echo_enabled' => env('DEF_COMPONENTS_ECHO_ENABLED', false),

    'allow_insecure' => env('DEF_COMPONENTS_ECHO_ALLOW_INSECURE', false),

];
