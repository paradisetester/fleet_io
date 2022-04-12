<?php

namespace App\Providers\Api\V1;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Http\Repositories\Api\V1\UserRepositoryInterface::class, \App\Http\Repositories\Api\V1\UserRepository::class);
        $this->app->bind(\App\Http\Repositories\Api\V1\TenantMgmtRepositoryInterface::class, \App\Http\Repositories\Api\V1\TenantMgmtRepository::class);
    }
}
