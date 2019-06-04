<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    /**
     * Relation avec les TeamMembers
     */
    public function teammembers() {
      return $this->belongsToMany('App\TeamMember');
    }

    /**
     * Relation avec le Client
     */
    public function client() {
      return $this->belongsTo('App\Client');
    }

    /**
     * Relation avec le Contrat
     */
    public function contrats() {
      return $this->hasMany('App\Contrat')->orderBy('start_date','desc');
    }
}
