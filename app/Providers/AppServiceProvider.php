<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('name', Auth::user()->name);
                $view->with('email', Auth::user()->email);
                $view->with('role', Auth::user()->role);
                $view->with('jabatan', Auth::user()->jabatan);
                $view->with('asal', Auth::user()->asal);
            }
        });
    }
}
