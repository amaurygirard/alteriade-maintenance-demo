<?php

namespace Database\Seeders\App;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContratsSeeder extends Seeder
{
    protected $faker;

    protected static $contrat_names = [
        'Maintenance et sécurité',
        'Maintenance préventive',
        'Maintenance préventive et évolutive',
    ];

    protected static $forfait_name = 'Forfait %d heures';

    protected static $forfait_durations = [
        8, 10, 12, 16,
    ];

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

        /*
         * Pour avoir de la variété,
         * on alternera les types de contrats annuel et forfaitaire
         */
        $projets_ids = DB::table('projets')
            ->select('id')
            ->inRandomOrder()
            ->pluck('id')
            ->toArray();

        $contrats = [];
        foreach ($projets_ids as $i => $id) {

            // Par défaut, contrat annuel
            $data = [
                'projet_id' => $id,
                'type' => 'annuel',
                'name' => $this->getRandomItemFromArray(self::$contrat_names),
                'start_date' => ($start_date = $this->faker->dateTimeBetween('-2 years'))->format('Y-m-d H:i:s'),
                'end_date' => (new DateTime())->setTimestamp(strtotime('+1 year', $start_date->getTimestamp()))->format('Y-m-d H:i:s'),
                'minutes_mensuelles' => 30,
                'minutes_in_forfait' => null,
                'created_at' => $carbon,
                'updated_at' => $carbon,
            ];

            // Un contrat sur deux de type forfaitaire
            if ($i % 2 === 0) {
                $hours_in_forfait = $this->getRandomItemFromArray(self::$forfait_durations);
                $data['type'] = 'forfait';
                $data['minutes_in_forfait'] = $hours_in_forfait * 60;
                $data['name'] = sprintf(self::$forfait_name, $hours_in_forfait);
                $data['end_date'] = null;
            }

            $contrats[] = $data;
        }

        // Intègre les données générées dans la base de données
        DB::table('contrats')->insert($contrats);
    }

    protected function getRandomItemFromArray(array $array)
    {
        $key = array_rand($array, 1);
        return $array[$key];
    }
}
