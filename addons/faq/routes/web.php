<?php

use App\Addons\Faq\Controllers\Client\FaqController;

Route::get('/faq/group/{group:slug}', [FaqController::class, 'group'])->name('index');