<?php

namespace App\Providers;

use App\Actions\CustomGetSummary;
use BenBjurstrom\Prezet\Actions\GetSummary;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GetSummary::class, CustomGetSummary::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        seo()
            ->site('Prezet')
            ->title(
                default: 'Prezet: Markdown Blogging for Laravel',
            )
            ->withUrl('https://prezet.com')
            ->description(default: 'Transform your markdown files into SEO-friendly blogs, articles, and documentation!')
            ->image(default: fn () => asset('ogimage.png'));
    }
}
