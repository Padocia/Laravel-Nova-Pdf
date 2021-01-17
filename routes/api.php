<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Middleware\ValidateSignature;
use Padocia\NovaPdf\Http\Controllers\DownloadController;
use Laravel\Nova\Http\Controllers\StyleController;

Route::get('/download', [DownloadController::class, 'download'])
    ->name('laravel-nova-pdf.download')
    ->middleware(ValidateSignature::class);

Route::get('/styles/{style}', [StyleController::class, 'show'])
    ->name('nova-pdf.tailwindcss');
