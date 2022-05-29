<?php

namespace App\Providers;


use App\Repositories\CompanyPackageRepository;
use App\Repositories\CompanyPackageRepositoryInterface;
use App\Repositories\CompanyRepository;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\PackageRepository;
use App\Repositories\PackageRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PackageRepositoryInterface::class,PackageRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class,CompanyRepository::class);
        $this->app->bind(CompanyPackageRepositoryInterface::class,CompanyPackageRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
