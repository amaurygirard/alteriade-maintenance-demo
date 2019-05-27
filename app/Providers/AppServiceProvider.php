<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contrat;
use App\Intervention;
use App\Observers\ContratObserver;
use App\Observers\InterventionObserver;

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
        Intervention::observe(InterventionObserver::class);
    }
}
