<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Intervention;

class Contrat extends Model
{

    /**
     * Indique le type d'objet
     */
    public $type = 'contrat';

    /**
     * Attributs d'expiration du contrat
     * Ne sont pas enregistrés en BDD
     * Mais sont calculés par la méthode calculateExpiration()
     */
    public $diff = false;
    public $is_close_to_end = false;
    public $is_ended = false;
    public $minutes_spent_monthly = false;

    public $latest_intervention = false;

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

    public function setMinutesSpentMonthlyAttribute(int $int) {
      $this->minutes_spent_monthly = $int;
    }

    public function setLatestInterventionAttribute(Intervention $intervention) {
      $this->latest_intervention = $intervention;
    }


    /**
     * Calcul des attributs d'expiration du contrat :
     * diff, is_ended et is_close_to_end
     */
    public function calculateExpiration() {

      /*
       * Date du jour
       */
      $now =  new \DateTime();


      /*
       * Pour les deux types de contrat, calcul du temps passé en maintenance mensuelle
       */
      // Date du début
      $startDate = \DateTime::createFromFormat('Y-m-d H:i:s', $this->start_date);

      // Nombre de mois écoulés depuis le début du contrat
      $diff_since_beginning = $startDate->diff($now);
      $months_since_beginning = ($diff_since_beginning->invert == 1) ? 0 : $diff_since_beginning->m + ($diff_since_beginning->y * 12) ;

      // Nombre total de minutes mensuelles
      $this->setMinutesSpentMonthlyAttribute( $this->minutes_mensuelles * $months_since_beginning );


      /*
       * Calcul de l'expiration pour un contrat de type annuel
       */
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


      /*
       * Calcul de l'expiration pour un contrat de type forfaitaire
       */
      else {

        $total_minutes_spent = Intervention::where(['contrat_id' => $this->id, 'is_probono' => 0])->sum('minutes_spent');

        $remaining_time = intval($this->minutes_in_forfait) - $total_minutes_spent - $this->minutes_spent_monthly;

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


    public function findLatestIntervention() {
      $intervention = Intervention::where('contrat_id', $this->id)->get()->sortByDesc('date')->first();

      if($intervention) $this->setLatestInterventionAttribute( $intervention );
    }


    /**
     * Relation avec le Projet
     */
    public function projet(){
      return $this->belongsTo('App\Projet');
    }


    /**
     * Relation avec les interventions
     */
    public function interventions(){
      return $this->hasMany('App\Intervention');
    }
}
