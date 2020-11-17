<?php


namespace DefStudio\Components;


use DefStudio\Components\View\Components\Alert;
use DefStudio\Components\View\Components\Button;
use DefStudio\Components\View\Components\Card;
use DefStudio\Components\View\Components\Checkbox;
use DefStudio\Components\View\Components\CheckboxSwitch;
use DefStudio\Components\View\Components\Context;
use DefStudio\Components\View\Components\Currency;
use DefStudio\Components\View\Components\Fieldset;
use DefStudio\Components\View\Components\File;
use DefStudio\Components\View\Components\Form;
use DefStudio\Components\View\Components\Hidden;
use DefStudio\Components\View\Components\Icon;
use DefStudio\Components\View\Components\LaravelMessages;
use DefStudio\Components\View\Components\Modal;
use DefStudio\Components\View\Components\Multiselect;
use DefStudio\Components\View\Components\Navbar;
use DefStudio\Components\View\Components\NavbarDropdownItem;
use DefStudio\Components\View\Components\NavbarItem;
use DefStudio\Components\View\Components\NavbarNav;
use DefStudio\Components\View\Components\Number;
use DefStudio\Components\View\Components\Password;
use DefStudio\Components\View\Components\Percent;
use DefStudio\Components\View\Components\Select;
use DefStudio\Components\View\Components\Styles;
use DefStudio\Components\View\Components\Table;
use DefStudio\Components\View\Components\TemplateAttachment;
use DefStudio\Components\View\Components\Text;
use DefStudio\Components\View\Components\TextArea;
use DefStudio\Components\View\Components\ToggleButton;
use DefStudio\Components\View\Components\Tools;
use DefStudio\Components\View\Components\Zoomable;
use DefStudio\Components\View\Components\ZoomButton;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->app->singleton(ContextStack::class);

        $this->loadRoutesFrom(__DIR__ . "/../routes/web.php");

        $this->loadViewsFrom(__DIR__ . "/../resources/views", 'def-components');

        $this->init_components();

        $this->loadTranslationsFrom(__DIR__ . "/../resources/lang", 'def-components');

        $this->init_assets();

    }

    private function init_components(): void
    {

        Blade::components([
            'def-components::row' => 'row',
            'def-components::col' => 'col',
        ], config('components.tags_prefix', ''));

        $this->loadViewComponentsAs(config('components.tags_prefix', ''), [
            Alert::class,
            Button::class,
            Card::class,
            Checkbox::class,
            CheckboxSwitch::class,
            Context::class,
            Currency::class,
            Table::class,
            Fieldset::class,
            File::class,
            Form::class,
            Hidden::class,
            Icon::class,
            Modal::class,
            Multiselect::class,
            LaravelMessages::class,
            Navbar::class,
            NavbarNav::class,
            NavbarItem::class,
            NavbarDropdownItem::class,
            Number::class,
            Password::class,
            Percent::class,
            Select::class,
            Styles::class,
            TemplateAttachment::class,
            Text::class,
            TextArea::class,
            ToggleButton::class,
            Tools::class,
            Zoomable::class,
            ZoomButton::class,
        ]);
    }

    private function init_assets(): void
    {
        $this->publishes([
            __DIR__ . "/../resources/views" => resource_path('views/vendor/def-components'),
        ], 'views');

        $this->publishes([
            __DIR__ . "/../config/components.php" => config_path('components.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . "/../resources/lang" => resource_path('lang/vendor/def-components'),
        ], 'lang');
    }


}
