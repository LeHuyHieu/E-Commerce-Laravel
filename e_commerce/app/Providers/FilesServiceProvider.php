<?php

namespace App\Providers;

use App\Services\FilesService;
use Illuminate\Support\ServiceProvider;

class FilesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('files_service', function($app) {
            return new FilesService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
