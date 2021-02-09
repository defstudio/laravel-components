<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

/** @noinspection PhpUnused */

namespace DefStudio\Components\Helpers;

class Arrays
{
    public static function are_equals($arr_1, $arr_2): bool
    {
        return $arr_1 == $arr_2;
    }

    public static function compare($arr_1, $arr_2): array
    {
        $result = [];
        foreach ($arr_1 as $key => $value) {
            $result[$key] = [
                'new' => data_get($arr_1, $key),
                'old' => data_get($arr_2, $key),
            ];
        }

        return $result;
    }

    public static function next_key($arr, $key, $wrap = false)
    {
        return self::neighbor_keys($arr, $key, $wrap)['next'];
    }

    /**
     * Function to get array keys on either side of a given key. If the
     * initial key is first in the array then prev is null. If the initial
     * key is last in the array, then next is null.
     *
     * If wrap is true and the initial key is last, then next is the first
     * element in the array.
     *
     * If wrap is true and the initial key is first, then prev is the last
     * element in the array.
     *
     * @param  array  $arr
     * @param  string  $key
     * @param  bool  $wrap
     *
     * @return array $return
     */
    public static function neighbor_keys(array $arr, string $key, $wrap = false): array
    {

        //krsort( $arr );
        $keys = array_keys($arr);
        $keyIndexes = array_flip($keys);

        $return = [];
        if (isset($keys[$keyIndexes[$key] - 1])) {
            $return['previous'] = $keys[$keyIndexes[$key] - 1];
        } else {
            $return['previous'] = null;
        }

        if (isset($keys[$keyIndexes[$key] + 1])) {
            $return['next'] = $keys[$keyIndexes[$key] + 1];
        } else {
            $return['next'] = null;
        }

        if (false != $wrap && empty($return['prev'])) {
            end($arr);
            $return['previous'] = key($arr);
        }

        if (false != $wrap && empty($return['next'])) {
            reset($arr);
            $return['next'] = key($arr);
        }

        return $return;
    }

    public static function previovus_key($arr, $key, $wrap = false)
    {
        return self::neighbor_keys($arr, $key, $wrap)['previous'];
    }
}
