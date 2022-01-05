<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjetsSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = Carbon::now()->format("Y-m-d H:i:s");

        // Retrouve les identifiants des clients et ceux de leurs utilisateurs, avec leur équipe
        $clients = DB::table('clients')
            ->selectRaw('clients.id as id, users.id as user_id, um.team as user_team')
            ->join('client_user as cu', 'clients.id', '=', 'cu.client_id')
            ->join('users', 'cu.user_id', '=', 'users.id')
            ->join('user_meta as um', 'users.id', '=', 'um.user_id')
            ->get()
            ->groupBy('id')
        ;

        foreach($clients as $id => $data) {

            // Chaque client aura 1, 2 ou 3 projets créé(s)
            $random = rand(1,3);
            for($i = 0; $i < $random; $i++) {

                // Crée le projet
                $projet_id = DB::table('projets')
                    ->insertGetId([
                        'client_id' => $id,
                        'name' => ucfirst($this->faker->words(3,true)),
                        'created_at' => $carbon,
                        'updated_at' => $carbon,
                    ]);

                // Prépare la relation avec un utilisateur de chacune des deux équipes 'cec' et 'consultant'
                $teams = ['cec', 'consultant'];
                $users = [];
                foreach($data as $user) {

                    $team = $user->user_team ?? null;
                    $user_id = $user->user_id ?? null;
                    if( $user_id && $team && ($key = array_search($team, $teams)) !== false ) {
                        unset($teams[$key]); // pour ne garder qu'un utilisateur par équipe

                        $users[] = [
                            'projet_id' => $projet_id,
                            'user_id' => $user_id,
                            'created_at' => $carbon,
                            'updated_at' => $carbon,
                        ];

                    }
                    else {
                        continue;
                    }

                    if( !count($teams) ) {
                        break;
                    }

                }

                // Insère les données dans la table
                if( count($users) ) {
                    DB::table('projet_user')->insert($users);
                }

            }

        }
    }
}
