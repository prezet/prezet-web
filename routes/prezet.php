<?php

use BenBjurstrom\Prezet\Http\Controllers\ImageController;
use BenBjurstrom\Prezet\Http\Controllers\IndexController;
use BenBjurstrom\Prezet\Http\Controllers\OgimageController;
use BenBjurstrom\Prezet\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;

Route::get('prezet/img/{path}', ImageController::class)
    ->name('prezet.image')
    ->where('path', '.*');

Route::get('/prezet/ogimage/{slug}', OgimageController::class)
    ->name('prezet.ogimage')
    ->where('slug', '.*');

Route::get('/', IndexController::class)
    ->name('prezet.index');

Route::get('{slug}', ShowController::class)
    ->name('prezet.show')
    ->where('slug', '.*');
// https://laravel.com/docs/11.x/routing#parameters-encoded-forward-slashes
