<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\ApiController;
use App\Services\WorldService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ApiController::class, WorldService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
