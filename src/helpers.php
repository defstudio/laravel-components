<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

/** @noinspection DuplicatedCode */

/** @noinspection PhpUndefinedFieldInspection */

use App\Models\User;
use DefStudio\Components\Helpers\BladeCompiler;
use DefStudio\Components\Helpers\DotCollection;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\VarDumper\VarDumper;

if (!function_exists('user')) {
    function user(): User|null
    {
        return Auth::user();
    }
}

if (!function_exists('str')) {
    /**
     * Get a new stringable object from the given string.
     *
     * @param  string|\Illuminate\Support\Stringable  $string  $string
     *
     * @return \Illuminate\Support\Stringable
     */
    function str(null|string|\Illuminate\Support\Stringable $string): \Illuminate\Support\Stringable
    {
        return \Illuminate\Support\Str::of($string ?? '');
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

if (!function_exists('dot_collect')) {
    function dot_collect(
        $value = null
    ): DotCollection {
        return DotCollection::make($value);
    }
}

if (!function_exists('dd_nth')) {
    function dd_nth(int $stop_at_index, $dump_all = false, ...$vars)
    {
        $iteration_count = $GLOBALS['dd_iterations'] ?? 0;
        $iteration_count++;

        if ($iteration_count >= $stop_at_index) {
            foreach ($vars as $v) {
                VarDumper::dump($v);
            }
            exit(1);
        } else {
            if ($dump_all) {
                foreach ($vars as $v) {
                    VarDumper::dump($v);
                }
            }
            $GLOBALS['dd_iterations'] = $iteration_count;
        }
    }
}

if (!function_exists('blade')) {
    function blade(): BladeCompiler
    {
        return app(BladeCompiler::class);
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
