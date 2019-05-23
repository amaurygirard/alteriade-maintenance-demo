<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{

    /**
     * Attributs d'expiration du contrat
     * Ne sont pas enregistrés en BDD
     * Mais sont calculés par la méthode calculateExpiration()
     */
    public $diff = false;
    public $is_close_to_end = false;
    public $is_ended = false;


    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'retrieved' => \App\Observers\ContratObserver::class,
    ];


    /**
     * Mutators pour les attributs d'expiration
     */
    public function setDiffAttribute($diff) {
      $this->diff = $diff;
    }

    public function setIsEndedAttribute(bool $bool) {
      $this->is_ended = $bool;
    }

    public function setIsCloseToEndAttribute(bool $bool) {
      $this->is_close_to_end = $bool;
    }


    /**
     * Calcul des attributs d'expiration du contrat :
     * diff, is_ended et is_close_to_end
     */
    public function calculateExpiration() {
      if( $this->type == 'annuel' ) {

        $endDate = \DateTime::createFromFormat('Y-m-d H:i:s', $this->end_date);
        $now =  new \DateTime();

        $this->setDiffAttribute( $now->diff($endDate) );

        if ($this->diff->invert == 1) { // 1 si date dans le passé

          $this->setIsEndedAttribute( true );
          $this->setIsCloseToEndAttribute( false );

        }
        else if (
          $this->diff->invert == 0 // date dans le futur
          && $this->diff->y < 1 && $this->diff->m < 2 // moins de 2 mois de différence
        ) {

          $this->setIsEndedAttribute( false );
          $this->setIsCloseToEndAttribute( true );

        }
        else {

          $this->setIsEndedAttribute( false );
          $this->setIsCloseToEndAttribute( false );

        }

      }
    }
}
