<?php

namespace App\Services;

use App\UserMeta;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected $usersTable = "users";
    protected $userMetaTable = "user_meta";

    /**
     * Retrouve les identifiants des utilisateurs d'une équipe donnée
     * ou de tous les utilisateurs en l'absence de nom d'équipe valide
     * @param string|null $team
     * @return \Illuminate\Support\Collection
     */
    public function getUsersIdsByTeam(string $team = null) : \Illuminate\Support\Collection
    {
        $query = DB::table($this->usersTable)->selectRaw("$this->usersTable.id as id");

        if( $team && in_array( $team, UserMeta::$teams ) ) {
            $query
                ->join($this->userMetaTable,"$this->usersTable.id",'=',"$this->userMetaTable.user_id")
                ->where("$this->userMetaTable.team", '=', $team);
        }

        return $query->pluck('id');
    }
}
