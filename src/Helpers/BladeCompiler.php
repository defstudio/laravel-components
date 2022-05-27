<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

/** @noinspection PhpUnhandledExceptionInspection */

namespace DefStudio\Components\Helpers;

use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Throwable;

class BladeCompiler
{
    public function render($content, $data = [], $compact = false): string
    {
        if (View::exists($content)) {
            return View::make($content, $data)->render();
        }

        $php = Blade::compileString($content);

        $obLevel = ob_get_level();
        ob_start();
        extract($data, EXTR_SKIP);

        try {
            eval('?'.'>'.$php);
        } catch (Exception $e) {
            while (ob_get_level() > $obLevel) {
                ob_end_clean();
            }
            throw $e;
        } catch (Throwable $e) {
            while (ob_get_level() > $obLevel) {
                ob_end_clean();
            }
            throw new Exception($e);
        }

        $html = ob_get_clean();

        if (!$html) {
            $html = '';
        }

        if($compact){
            $html = preg_replace('/\n/', ' ', $html);
            $html = preg_replace('/\s+/', ' ', $html);
        }

        return $html;
    }
}
