<?php

use DefStudio\Components\Controllers\NotificationController;
use DefStudio\Components\Controllers\TemplateAttachmentController;
use Illuminate\Support\Facades\Route;


Route::middleware('web')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('def-components/notifications', [NotificationController::class, 'index'])->name('def-components.notifications.index');
    });

    Route::middleware('signed')->group(function () {
        Route::post('def-components/template/{filename}', [TemplateAttachmentController::class, 'build_template'])->name('def-components.download.template');
    });

});


