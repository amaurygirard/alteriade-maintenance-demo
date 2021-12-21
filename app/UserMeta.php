<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_meta';

    /**
     * The existing teams in app
     * @var string[]
     */
    public static $teams = [
        'web',
        'cec',
        'consultant'
    ];

    /**
     * Retrouve l'utilisateur dont il s'agit
     */
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
