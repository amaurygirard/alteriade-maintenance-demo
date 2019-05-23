<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contrat;
use App\Observers\ContratObserver;

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
        Contrat::observe(ContratObserver::class);
    }
}
