<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class GlobalVariableServiceProvider extends ServiceProvider
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
        View::composer('*', function ($view) {
            $TimeUnit = [
                0 => 'Day',
                1 => 'Month',
                2 =>'Year',
                // Add more key-value pairs as needed
            ];
            $view->with('TimeUnit', $TimeUnit);
        });
    }
}
