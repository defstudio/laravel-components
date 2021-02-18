<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components;


use DefStudio\Components\View\Components\Alert;
use DefStudio\Components\View\Components\Button;
use DefStudio\Components\View\Components\Card;
use DefStudio\Components\View\Components\Checkbox;
use DefStudio\Components\View\Components\CheckboxSwitch;
use DefStudio\Components\View\Components\Col;
use DefStudio\Components\View\Components\Context;
use DefStudio\Components\View\Components\Currency;
use DefStudio\Components\View\Components\Datepicker;
use DefStudio\Components\View\Components\DateValue;
use DefStudio\Components\View\Components\Email;
use DefStudio\Components\View\Components\Fieldset;
use DefStudio\Components\View\Components\File;
use DefStudio\Components\View\Components\FloatNumber;
use DefStudio\Components\View\Components\Form;
use DefStudio\Components\View\Components\Hidden;
use DefStudio\Components\View\Components\Icon;
use DefStudio\Components\View\Components\LaravelMessages;
use DefStudio\Components\View\Components\Modal;
use DefStudio\Components\View\Components\Multiselect;
use DefStudio\Components\View\Components\NamePrefix;
use DefStudio\Components\View\Components\Navbar;
use DefStudio\Components\View\Components\NavbarDropdownItem;
use DefStudio\Components\View\Components\NavbarItem;
use DefStudio\Components\View\Components\NavbarNav;
use DefStudio\Components\View\Components\Number;
use DefStudio\Components\View\Components\Password;
use DefStudio\Components\View\Components\Percent;
use DefStudio\Components\View\Components\Radio;
use DefStudio\Components\View\Components\Row;
use DefStudio\Components\View\Components\Select;
use DefStudio\Components\View\Components\Styles;
use DefStudio\Components\View\Components\Table;
use DefStudio\Components\View\Components\TemplateAttachment;
use DefStudio\Components\View\Components\Text;
use DefStudio\Components\View\Components\TextArea;
use DefStudio\Components\View\Components\ToggleButton;
use DefStudio\Components\View\Components\Tools;
use DefStudio\Components\View\Components\Value;
use DefStudio\Components\View\Components\Zoomable;
use DefStudio\Components\View\Components\ZoomButton;
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
            Col::class,
            Context::class,
            Currency::class,
            Datepicker::class,
            DateValue::class,
            Email::class,
            Fieldset::class,
            File::class,
            Form::class,
            FloatNumber::class,
            Hidden::class,
            Icon::class,
            Modal::class,
            Multiselect::class,
            LaravelMessages::class,
            NamePrefix::class,
            Navbar::class,
            NavbarNav::class,
            NavbarItem::class,
            NavbarDropdownItem::class,
            Number::class,
            Password::class,
            Percent::class,
            Radio::class,
            Row::class,
            Select::class,
            Styles::class,
            Table::class,
            TemplateAttachment::class,
            Text::class,
            TextArea::class,
            ToggleButton::class,
            Tools::class,
            Value::class,
            Zoomable::class,
            ZoomButton::class,
        ]);

        $this->loadRoutesFrom(__DIR__."/../routes/web.php");

        $this->loadViewsFrom(__DIR__."/../resources/views", 'def-components');


        $this->loadTranslationsFrom(__DIR__."/../resources/lang", 'def-components');

        $this->mergeConfigFrom(__DIR__."/../config/components.php", 'components');


        $this->publishes([
            __DIR__."/../resources/views" => resource_path('views/vendor/def-components'),
        ], 'views');

        $this->publishes([
            __DIR__."/../config/components.php" => config_path('components.php'),
        ], 'config');

        $this->publishes([
            __DIR__."/../resources/lang" => resource_path('lang/vendor/def-components'),
        ], 'lang');
    }
}
