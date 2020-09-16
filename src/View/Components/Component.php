<?php


namespace DefStudio\Components\View\Components;


use DefStudio\Components\Traits\BindsModels;
use DefStudio\Components\Traits\InteractsWithContext;

abstract class Component extends \Illuminate\View\Component
{
    use InteractsWithContext;
    use BindsModels;
}
