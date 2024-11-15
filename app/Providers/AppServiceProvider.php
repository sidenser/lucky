<?php

namespace App\Providers;

use App\Models\User;
use App\Models\UserLinkedInterface;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(UserLinkedInterface::class, function (Application $app) {
//            return dd('asdasd');
//        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
