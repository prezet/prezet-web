<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/features/markdown', '/content', 301);
Route::redirect('/customize/routes', '/customize/templates', 301);
Route::redirect('/customize/blade-views', '/customize/templates', 301);
Route::redirect('/customize/controllers', '/customize/templates', 301);
Route::redirect('/deployment/analytics', '/deployment/laravel-cloud', 301);

Route::feeds();
require __DIR__.'/prezet.php';
