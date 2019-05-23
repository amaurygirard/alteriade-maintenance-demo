<?php

namespace App\Observers;

use App\Contrat;

class ContratObserver
{
    /**
     * Handle the contrat "retrieved" event.
     *
     * @param  \App\Contrat  $contrat
     * @return void
     */
    public function retrieved(Contrat $contrat)
    {
        $contrat->calculateExpiration();
        // return $contrat;
    }

    /**
     * Handle the contrat "created" event.
     *
     * @param  \App\Contrat  $contrat
     * @return void
     */
    public function created(Contrat $contrat)
    {
        //
    }

    /**
     * Handle the contrat "updated" event.
     *
     * @param  \App\Contrat  $contrat
     * @return void
     */
    public function updated(Contrat $contrat)
    {
        //
    }

    /**
     * Handle the contrat "deleted" event.
     *
     * @param  \App\Contrat  $contrat
     * @return void
     */
    public function deleted(Contrat $contrat)
    {
        //
    }

    /**
     * Handle the contrat "restored" event.
     *
     * @param  \App\Contrat  $contrat
     * @return void
     */
    public function restored(Contrat $contrat)
    {
        //
    }

    /**
     * Handle the contrat "force deleted" event.
     *
     * @param  \App\Contrat  $contrat
     * @return void
     */
    public function forceDeleted(Contrat $contrat)
    {
        //
    }
}
