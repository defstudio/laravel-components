<?php


namespace DefStudio\Components\Traits;


use Illuminate\Http\Request;
use Illuminate\Session\Store;

trait InteractsWithRequest
{
    private function draft_value($default)
    {
        return request()->session()->get("draft." . $this->dotted_field_name(), $default);
    }

    private function old_value($default)
    {
        return request()->old($this->dotted_field_name(), $default);
    }

    private function session(): Store
    {
        return $this->request()->session();
    }

    private function request(): Request
    {
        return request();
    }
}
