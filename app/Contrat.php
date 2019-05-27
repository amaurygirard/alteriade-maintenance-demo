<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Intervention;

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

      $now =  new \DateTime();

      if( $this->type == 'annuel' ) {

        $endDate = \DateTime::createFromFormat('Y-m-d H:i:s', $this->end_date);

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
      else {

        $total_minutes_spent = Intervention::where(['contrat_id' => $this->id, 'is_probono' => 0])->sum('minutes_spent');

        $remaining_time = intval($this->minutes_in_forfait) - $total_minutes_spent;

        if($remaining_time >= 120) { // plus de 2h restantes

            $this->setIsEndedAttribute( false );
            $this->setIsCloseToEndAttribute( false );

        }
        else if($remaining_time > 0) {

          $this->setIsEndedAttribute( false );
          $this->setIsCloseToEndAttribute( true );

        }
        else {

          $this->setIsEndedAttribute( true );
          $this->setIsCloseToEndAttribute( false );

        }

        $time_diff = new \DateTime;
        $time_diff->setTimestamp(strtotime('-'.$remaining_time.' minutes', $now->getTimestamp()));

        $this->setDiffAttribute( $now->diff($time_diff) );

      }

    }
}
