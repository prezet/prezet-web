<?php

namespace App\Providers;

use App\Actions\CustomGetSummary;
use App\Actions\CustomUpdateIndex;
use App\Data\CustomFrontmatterData;
use Prezet\Prezet\Actions\GetSummary;
use Prezet\Prezet\Actions\UpdateIndex;
use Prezet\Prezet\Data\FrontmatterData;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FrontmatterData::class, CustomFrontmatterData::class);
        $this->app->bind(GetSummary::class, CustomGetSummary::class);
        $this->app->bind(UpdateIndex::class, CustomUpdateIndex::class);
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
