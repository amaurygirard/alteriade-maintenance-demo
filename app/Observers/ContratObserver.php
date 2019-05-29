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
        $contrat->findLatestIntervention();
    }
}
