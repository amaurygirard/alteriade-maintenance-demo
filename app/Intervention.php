<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    /**
     * Indique le type d'objet
     */
    public $modelName = 'intervention';

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

    /**
     * Liste des types valides
     * @var string[]
     */
    public static $types = [
        "correctif",
        "update",
        "sauvegarde",
        "minor_change",
        "assistance",
        "new_feature",
        "autre",
    ];

    /*
     * Les valeurs enregistrées en BDD seront traduites sur le template
     * selon la valeur associée à la clé
     */
    public static $readableTypes = [
        'correctif' => 'Correction de bug',
        'update' => 'Mise à jour',
        'sauvegarde' => 'Sauvegarde',
        'minor_change' => 'Modification mineure',
        'assistance' => 'Assistance',
        'new_feature' => 'Nouvelle fonctionnalité',
        'autre' => 'Autre'
    ];

    public function setReadableTypeAttribute($readable_type) {
        $this->readable_type = $readable_type;
    }

    public function findReadableType() {
        return self::$readableTypes[$this->type] ?? false;
    }

    public function findAndSetReadableType() {

        $readable_type = $this->findReadableType();
        $readable_type = ($readable_type) ? $readable_type : $this->type;

        $this->setReadableTypeAttribute( $readable_type );

    }

    public function contrat() {
      return $this->belongsTo('App\Contrat');
    }

    /**
     * Relation avec les Utilisateurs
     */
    public function users() {
      return $this->belongsToMany('App\User');
    }
}
