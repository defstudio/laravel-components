<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

/** @noinspection PhpUndefinedFieldInspection */

use Carbon\CarbonInterface;
use DefStudio\Components\Helpers\DotCollection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Symfony\Component\VarDumper\VarDumper;


if (!function_exists('str')) {
    /**
     * Get a new stringable object from the given string.
     *
     * @param  string|\Illuminate\Support\Stringable  $string  $string
     *
     * @return \Illuminate\Support\Stringable
     */
    function str(string|\Illuminate\Support\Stringable $string): \Illuminate\Support\Stringable
    {
        return \Illuminate\Support\Str::of($string);
    }
}

if (!function_exists('back')) {
    /**
     * Create a new redirect response to the previous location.
     *
     * @param  int  $status
     * @param  array  $headers
     * @param  mixed  $fallback
     *
     * @return RedirectResponse
     */
    function back($status = 302, $headers = [], $fallback = false): RedirectResponse
    {
        if (request()->has('referer')) {
            return app('redirect')->to(request()->referer, $status, $headers);
        }
        return app('redirect')->back($status, $headers, $fallback);
    }
}

if (!function_exists('carbon')) {
    function carbon(mixed $datetime): CarbonInterface|null
    {
        return Carbon::make($datetime);
    }
}

if (!function_exists('dot_collect')) {
    function dot_collect(
        $value = null
    ): DotCollection {
        return DotCollection::make($value);
    }
}

if (!function_exists('dd_nth')) {
    function dd_nth(int $nth, ...$vars)
    {

        $iteration_count = $GLOBALS['dd_iterations'] ?? 0;
        $iteration_count++;

        if ($iteration_count >= $nth) {
            foreach ($vars as $v) {
                VarDumper::dump($v);
            }
            exit(1);
        } else {
            $GLOBALS['dd_iterations'] = $iteration_count;
        }
    }
}

if (!function_exists('array_undot')) {
    function array_undot(array $dot_array): array
    {
        $array = [];
        foreach ($dot_array as $key => $value) {
            data_set($array, $key, $value);
        }
        return $array;
    }
}

if (!function_exists('array_unarrow')) {
    function array_unarrow(array $arrow_array): array
    {
        $array = [];
        foreach ($arrow_array as $key => $value) {
            data_set($array, str($key)->replace('->', '.'), $value);
        }
        return $array;
    }
}
