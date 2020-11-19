<?php

namespace App\Providers;

use App\Models\PersonalAccessToken;
use App\Support\Executor;
use App\Support\Responder;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('responder', function () {
            return new Responder;
        });

        $this->app->bind('executor', function () {
            return new Executor;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
