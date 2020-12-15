<?php

if (!function_exists('str')) {
    /**
     * Get a new stringable object from the given string.
     *
     * @param string $string
     *
     * @return \Illuminate\Support\Stringable
     */
    function str($string): \Illuminate\Support\Stringable
    {
        return \Illuminate\Support\Str::of($string);
    }
}
