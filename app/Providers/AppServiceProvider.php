<?php

namespace App\Providers;

use App\Models\CarBrand;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap(); // For Bootstrap 5    

        view()->composer('Admin.Cars.all-cars-model', function($view){
            $view->with('brands' , CarBrand::all());
        });
    }
}
