<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    /**
     * Indique le type d'objet
     */
    public $type = 'client';

    /**
     * Relation avec les Utilisateurs
     */
     public function users() {
       return $this->belongsToMany('App\User');
     }

    /**
     * Relation avec les Projets
     */
     public function projets() {
       return $this->hasMany('App\Projet');
     }
}
