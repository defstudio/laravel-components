<?php


namespace DefStudio\Components\Traits;


use DefStudio\Components\ContextStack;

trait InteractsWithContext
{
    public function context(): ContextStack
    {
        return app(ContextStack::class);
    }
}
