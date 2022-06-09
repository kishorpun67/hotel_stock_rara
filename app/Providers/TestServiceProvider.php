<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Example;
class TestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('example' , function($name){
            return new Example($name);
        });
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
