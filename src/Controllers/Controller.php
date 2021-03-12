<?php


namespace DefStudio\Components\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\URL;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
    
    protected function flash_back_url(): void
    {
        session()->now('_back', session()->get('_back', URL::previous()));
    }
    
    protected function default_redirect_url(): string{
        return route('home');
    }
    
    protected function redirect_back(string $default = null): RedirectResponse
    {
        return redirect()->to(session()->get('_back', $default ?? $this->default_redirect_url()));
    }
}