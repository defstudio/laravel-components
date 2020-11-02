<?php

use DefStudio\Components\Controllers\TemplateAttachmentController;
use Illuminate\Support\Facades\Route;

Route::middleware('signed')->group(function () {
    Route::post('def-components/template/{filename}', [TemplateAttachmentController::class, 'build_template'])->name('def-components.download.template');
});
