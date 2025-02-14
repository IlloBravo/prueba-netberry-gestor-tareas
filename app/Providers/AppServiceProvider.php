<?php

namespace App\Providers;

use App\Services\Contracts\CreateTaskServiceInterface;
use App\Services\Contracts\DeleteTaskServiceInterface;
use App\Services\CreateTaskService;
use App\Services\DeleteTaskService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DeleteTaskServiceInterface::class, DeleteTaskService::class);
        $this->app->bind(CreateTaskServiceInterface::class, CreateTaskService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
