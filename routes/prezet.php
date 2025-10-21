<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OgimageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;

Route::get('prezet/search', SearchController::class)->name('prezet.search');

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



Route::redirect('/features/markdown', '/content', 308);
Route::redirect('/customize/routes', '/customize/templates', 308);
Route::redirect('/customize/blade-views', '/customize/templates', 308);
Route::redirect('/customize/controllers', '/customize/templates', 308);
Route::redirect('/deployment/analytics', '/deployment/laravel-cloud', 308);
