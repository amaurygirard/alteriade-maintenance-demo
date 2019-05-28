<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * Relation avec les TeamMembers
     */
     public function teammembers() {
       return $this->belongsToMany('App\TeamMember');
     }
}
