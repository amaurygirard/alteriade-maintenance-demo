<?php

namespace App\Observers;

use App\Intervention;

class InterventionObserver
{
    /**
     * Handle the intervention "retrieved" event.
     *
     * @param  \App\Intervention  $intervention
     * @return void
     */
    public function retrieved(Intervention $intervention)
    {
        $intervention->findAndSetReadableType();
    }
}
