<?php


namespace DefStudio\Components;


use DefStudio\Components\View\Components\Button;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    public function boot(){
        $this->loadViewsFrom(__DIR__."/resources/views", 'def-components');
        $this->loadViewComponentsAs('def', [
            Button::class
        ]);
    }
}
