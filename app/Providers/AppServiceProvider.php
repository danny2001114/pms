<?php

namespace App\Providers;

use App\Contracts\Dao\ProjectDaoInterface;
use App\Contracts\Dao\ProjectTypeDaoInterface;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\ProjectServiceInterface;
use App\Contracts\Services\ProjectTypeServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Dao\ProjectDao;
use App\Dao\ProjectTypeDao;
use App\Dao\UserDao;
use App\Services\ProjectService;
use App\Services\ProjectTypeService;
use App\Services\UserService;
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
        $this->app->bind(UserServiceInterface::class, UserService::class);

        // Dao registrations
        $this->app->bind(ProjectDaoInterface::class, ProjectDao::class);
        $this->app->bind(ProjectTypeDaoInterface::class, ProjectTypeDao::class);
        $this->app->bind(UserDaoInterface::class, UserDao::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
