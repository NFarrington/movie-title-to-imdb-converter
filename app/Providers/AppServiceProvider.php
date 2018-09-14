<?php

namespace App\Providers;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('guzzle', function () {
            return new GuzzleClient(['timeout' => 20]);
        });
    }
}
