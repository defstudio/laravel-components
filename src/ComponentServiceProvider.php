<?php


namespace DefStudio\Components;


use DefStudio\Components\View\Components\Alert;
use DefStudio\Components\View\Components\Button;
use DefStudio\Components\View\Components\Card;
use DefStudio\Components\View\Components\Checkbox;
use DefStudio\Components\View\Components\CheckboxSwitch;
use DefStudio\Components\View\Components\Context;
use DefStudio\Components\View\Components\Datatable;
use DefStudio\Components\View\Components\File;
use DefStudio\Components\View\Components\Form;
use DefStudio\Components\View\Components\Hidden;
use DefStudio\Components\View\Components\Icon;
use DefStudio\Components\View\Components\LaravelMessages;
use DefStudio\Components\View\Components\Modal;
use DefStudio\Components\View\Components\Multiselect;
use DefStudio\Components\View\Components\Navbar;
use DefStudio\Components\View\Components\NavbarDropdown;
use DefStudio\Components\View\Components\NavbarDropdownItem;
use DefStudio\Components\View\Components\NavbarNav;
use DefStudio\Components\View\Components\Password;
use DefStudio\Components\View\Components\Select;
use DefStudio\Components\View\Components\Styles;
use DefStudio\Components\View\Components\Text;
use DefStudio\Components\View\Components\ToggleButton;
use DefStudio\Components\View\Components\Tools;
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
            File::class,
            Form::class,
            Hidden::class,
            Icon::class,
            Modal::class,
            Multiselect::class,
            LaravelMessages::class,
            Navbar::class,
            NavbarNav::class,
            NavbarDropdown::class,
            NavbarDropdownItem::class,
            Password::class,
            Select::class,
            Styles::class,
            Text::class,
            ToggleButton::class,
            Tools::class,
        ]);

        $this->loadViewsFrom(__DIR__ . "/../resources/views", 'def-components');

        $this->loadTranslationsFrom(__DIR__ . "/../resources/lang", 'def-components');


        $this->publishes([
            __DIR__ . "/../resources/views" => resource_path('views/vendor/def-components'),
        ], 'views');

        $this->publishes([
            __DIR__ . "/../config/components.php" => config_path('components.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . "/../resources/lang" => resource_path('lang/vendor/def-components'),
        ], 'lang');

        $this->publish_assets();

    }

    private function publish_assets(): void
    {
        if (!file_exists(public_path('js/defstudio/components'))) {
            mkdir(public_path('js/defstudio/components'), 0777, true);
        }
        if (!file_exists(public_path('css/defstudio/components'))) {
            mkdir(public_path('css/defstudio/components'), 0777, true);
        }

        if (!file_exists(public_path('js/defstudio/components/tools.js'))) {
            symlink(__DIR__ . "/../resources/js/tools.js", public_path('js/defstudio/components/tools.js'));
        }
        if (!file_exists(public_path('js/defstudio/components/summernote-bs4.js'))) {
            symlink(__DIR__ . "/../resources/js/summernote-bs4.js", public_path('js/defstudio/components/summernote-bs4.js'));
        }
        if (!file_exists(public_path('css/defstudio/components/summernote-bs4.css'))) {
            symlink(__DIR__ . "/../resources/css/summernote-bs4.css", public_path('css/defstudio/components/summernote-bs4.css'));
        }


    }

}
