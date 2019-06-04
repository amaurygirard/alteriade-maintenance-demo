<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

use App\Client;

class ViewServiceProvider extends ServiceProvider
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
        // Using class based composers...
        // View::composer(
        //     'components.client_list', 'App\Http\View\Composers\ClientComposer'
        // );

        // Using Closure based composers...
        View::composer('components.client_list', function ($view) {
            $view->with('clients', Client::all());
        });

        /*
         * Utilisateur actif
         */
        View::share('user', Auth::user());
    }
}
