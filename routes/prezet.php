<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OgimageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

Route::withoutMiddleware([
        ShareErrorsFromSession::class,
        StartSession::class,
        ValidateCsrfToken::class,
        Illuminate\Cookie\Middleware\EncryptCookies::class,
        Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    ])
    ->middleware('cache.headers:public;max_age=0;s_maxage=31536000;must_revalidate')
    ->group(function () {
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



        Route::redirect('/features/markdown', '/content', 301);
        Route::redirect('/customize/routes', '/customize/templates', 301);
        Route::redirect('/customize/blade-views', '/customize/templates', 301);
        Route::redirect('/customize/controllers', '/customize/templates', 301);
        Route::redirect('/deployment/analytics', '/deployment/laravel-cloud', 301);
});
