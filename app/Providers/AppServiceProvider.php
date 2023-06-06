<?php

namespace App\Providers;

use App\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        
        view()->composer('*', function ($view) 
        {
            if (Auth::guard('cus')->check()) {
                 $totalFavorites = Favorite::where('customer_id',Auth::guard('cus')->user()->id)->count();  // for example
                 
            }else{
                $totalFavorites = 0;
               
            }

            $view->with(compact('totalFavorites'));
        });
    }
}
