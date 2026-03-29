<?php

namespace App\Providers;

use App\Contracts\Dao\ProjectDaoInterface;
use App\Contracts\Dao\ProjectTypeDaoInterface;
use App\Contracts\Services\ProjectServiceInterface;
use App\Contracts\Services\ProjectTypeServiceInterface;
use App\Dao\ProjectDao;
use App\Dao\ProjectTypeDao;
use App\Services\ProjectService;
use App\Services\ProjectTypeService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Services registrations
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);
        $this->app->bind(ProjectTypeServiceInterface::class, ProjectTypeService::class);

        // Dao registrations
        $this->app->bind(ProjectDaoInterface::class, ProjectDao::class);
        $this->app->bind(ProjectTypeDaoInterface::class, ProjectTypeDao::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
