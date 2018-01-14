<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\GasStationRepository::class, \App\Repositories\GasStationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CommentsRepository::class, \App\Repositories\CommentsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SeriesRepository::class, \App\Repositories\SeriesRepositoryEloquent::class);
        //:end-bindings:
    }
}
