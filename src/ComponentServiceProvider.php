<?php


namespace DefStudio\Components;


use DefStudio\Components\View\Components\Alert;
use DefStudio\Components\View\Components\Button;
use DefStudio\Components\View\Components\Card;
use DefStudio\Components\View\Components\Checkbox;
use DefStudio\Components\View\Components\CheckboxSwitch;
use DefStudio\Components\View\Components\Context;
use DefStudio\Components\View\Components\Datatable;
use DefStudio\Components\View\Components\Form;
use DefStudio\Components\View\Components\Hidden;
use DefStudio\Components\View\Components\Icon;
use DefStudio\Components\View\Components\Multiselect;
use DefStudio\Components\View\Components\Navbar;
use DefStudio\Components\View\Components\NavbarDropdown;
use DefStudio\Components\View\Components\NavbarDropdownItem;
use DefStudio\Components\View\Components\NavbarNav;
use DefStudio\Components\View\Components\Password;
use DefStudio\Components\View\Components\Select;
use DefStudio\Components\View\Components\Text;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->app->singleton(ContextStack::class);

        $this->loadViewComponentsAs(config('components.tags_prefix', ''), [
            Alert::class,
            Button::class,
            Card::class,
            Checkbox::class,
            CheckboxSwitch::class,
            Context::class,
            Datatable::class,
            Form::class,
            Hidden::class,
            Icon::class,
            Multiselect::class,
            Navbar::class,
            NavbarNav::class,
            NavbarDropdown::class,
            NavbarDropdownItem::class,
            Password::class,
            Select::class,
            Text::class,
        ]);

        $this->loadViewsFrom(__DIR__ . "/../resources/views", 'def-components');


        $this->publishes([
            __DIR__ . "/../resources/views" => resource_path('views/vendor/def-components'),
        ], 'views');

        $this->publishes([
            __DIR__ . "/../config/components.php" => config_path('components.php'),
        ], 'config');


    }
}
