<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    /**
     * Attribut qui sera appelé sur les templates à la place de $type
     * Pour faire la correspondance en termes compréhensibles avec la valeur enregistrée en BDD
     */
    public $readable_type = false;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'retrieved' => \App\Observers\InterventionObserver::class,
    ];


    public function setReadableTypeAttribute($readable_type) {
        $this->readable_type = $readable_type;
    }

    public function findReadableType() {
        /*
         * Les valeurs enregistrées en BDD seront traduites sur le template
         * selon la valeur associée à la clé
         */
        $cases = [
          'correctif' => 'Correction de bug',
          'update' => 'Mise à jour',
          'sauvegarde' => 'Sauvegarde',
          'minor_change' => 'Modification mineure',
          'assistance' => 'Assistance',
          'new_feature' => 'Nouvelle fonctionnalité',
          'autre' => 'Autre'
          // intégrer ici d'autres cas...
        ];

        if(isset($cases[$this->type])) {
          return $cases[$this->type];
        }
        else {
          return false;
        }

    }

    public function findAndSetReadableType() {

        $readable_type = $this->findReadableType();
        $readable_type = ($readable_type) ? $readable_type : $this->type;

        $this->setReadableTypeAttribute( $readable_type );

    }
}
