<?php


namespace DefStudio\Components;


use DefStudio\Components\View\Components\Button;
use DefStudio\Components\View\Components\Checkbox;
use DefStudio\Components\View\Components\CheckboxSwitch;
use DefStudio\Components\View\Components\Datatable;
use DefStudio\Components\View\Components\Icon;
use DefStudio\Components\View\Components\Password;
use DefStudio\Components\View\Components\Text;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    public function boot(){
        $this->loadViewsFrom(__DIR__."/resources/views", 'def-components');
        $this->loadViewComponentsAs('def', [
            Button::class,
            Datatable::class,
            Icon::class,
            Text::class,
            Password::class,
            Checkbox::class,
            CheckboxSwitch::class,
        ]);
    }
}
