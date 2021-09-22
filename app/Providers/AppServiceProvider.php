<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Include Schema
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // https://laravel-news.com/laravel-5-4-key-too-long-error
        // Fix Laravel 5.4  utf8mb4:
        Schema::defaultStringLength(191);
        // Fix Laravel 8.0 to use bootstrap for paginator instead of new TailwindCSS default
        Paginator::useBootstrap();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return base_path().'/public_html';
        });
    }
}
