<?php

use Illuminate\Http\RedirectResponse;

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

if (!function_exists('back')) {
    /**
     * Create a new redirect response to the previous location.
     *
     * @param int   $status
     * @param array $headers
     * @param mixed $fallback
     *
     * @return RedirectResponse
     */
    function back($status = 302, $headers = [], $fallback = false)
    {
        if (request()->has('referer')) {
            return app('redirect')->to(request()->referer, $status, $headers);
        }
        return app('redirect')->back($status, $headers, $fallback);
    }
}
