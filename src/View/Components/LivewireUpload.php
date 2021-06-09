<?php


namespace DefStudio\Components\View\Components;


use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\TemporaryUploadedFile;

class LivewireUpload extends Component
{
    public function __construct(
        public string $name,
        public string $key,
        public TemporaryUploadedFile|null $uploadedFile = null,
    )
    {
    }

    public function render(): View|Factory|Htmlable|Closure|string|Application
    {
        return view('def-components::livewire-upload');
    }
}
