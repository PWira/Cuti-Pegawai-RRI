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
                $view->with('user_nip', Auth::user()->user_nip);
                $view->with('email', Auth::user()->email);
                $view->with('roles', Auth::user()->roles);
                $view->with('user_jabatan', Auth::user()->user_jabatan);
                $view->with('user_unit_id', Auth::user()->user_unit_id);
            }
        });
    }
}
