<?php

use App\Intervention;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterventionsSeeder extends Seeder
{
    protected $faker;
    protected $web_team_members;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
        $this->populateWebTeamMembers();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contrats_ids = DB::table('contrats')
            ->select('id', 'start_date', 'end_date', 'type', 'minutes_in_forfait' )
            ->get()
            ->toArray();

        foreach($contrats_ids as $values) {

            /*
             * On crée pour chaque contrat entre 0 et 10 interventions
             */
            $max = rand(0,10);
            $total_minutes = 0;

            for($i = 0; $i < $max; $i++) {

                $data = [
                    'contrat_id' => $values->id,
                    'type' => $this->getRandomItemFromArray(Intervention::$types),
                    'minutes_spent' => $minutes = rand(15,120),
                    'date' => $date = $this->faker->dateTimeBetween($values->start_date, $values->end_date ?? 'now')->format('Y-m-d H:i:s'),
                    'description' => $this->faker->sentence(20, true),
                    'is_probono' => false,
                    'created_at' => $date,
                    'updated_at' => $date,
                ];

                // Insert intervention into DB
                $intervention_id = DB::table('interventions')->insertGetId($data);

                // Assign intervention to web team member
                DB::table('intervention_user')->insert([
                    [
                        'intervention_id' => $intervention_id,
                        'user_id' => $this->getRandomItemFromArray($this->web_team_members),
                        'created_at' => $date,
                        'updated_at' => $date,
                    ],
                ]);

                if( $values->type == 'forfait' ) {

                    // La boucle s'arrête si le temps imparti dans le forfait est dépassé ou sur le point de l'être
                    $total_minutes += $minutes;
                    if( $total_minutes >= $values->minutes_in_forfait - 20 ) {
                        break;
                    }

                }
            }
        }
    }

    protected function getRandomItemFromArray(array $array)
    {
        $key = array_rand($array, 1);
        return $array[$key];
    }

    protected function populateWebTeamMembers()
    {
        $this->web_team_members = DB::table('users')->select('users.id')
            ->join('user_meta as um', 'users.id', '=', 'um.user_id')
            ->where('um.team', '=', 'web')
            ->pluck('id')
            ->toArray()
        ;
    }
}
