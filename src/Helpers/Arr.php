<?php


namespace DefStudio\Components\Helpers;


class Arr extends \Illuminate\Support\Arr
{
    public static function forget(&$array, $keys)
    {
        $original = &$array;

        $keys = (array)$keys;

        if (count($keys) === 0) {
            return;
        }

        foreach ($keys as $key) {
            // if the exact key exists in the top-level, remove it
            if (static::exists($array, $key)) {
                unset($array[$key]);

                continue;
            }

            $parts = explode('.', $key);

            // clean up before each pass
            $array = &$original;

            while (count($parts) > 1) {
                $part = array_shift($parts);

                if (isset($array[$part]) && is_array($array[$part])) {
                    $array = &$array[$part];
                } elseif ($part === '*') {
                    foreach ($array as &$arr) {
                        static::forget($arr, implode('.', $parts));
                    }
                } else {
                    continue 2;
                }
            }

            unset($array[array_shift($parts)]);
        }
    }

}
