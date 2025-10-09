<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (!file_exists(public_path('storage'))) {
                Artisan::call('storage:link');
            }
        } catch (\Exception $e) {
            // opsional: tulis log
            \Log::error('Gagal membuat storage link: '.$e->getMessage());
        }
    }
}