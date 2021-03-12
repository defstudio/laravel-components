<?php


namespace DefStudio\Components\Requests;


class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    protected function getRedirectUrl()
    {
        if($this->has('_back')){
            session()->flash('_back', $this->get('_back'));
        }
        
        return parent::getRedirectUrl();
    }
}