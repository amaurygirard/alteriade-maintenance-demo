<?php

namespace Database\Seeders\App;

use App\Services\UserService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    protected $userService;

    // Teams
    protected $consultants;
    protected $cecs;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        // Load users ids by team for seeder's use
        $this->consultants = $this->userService->getUsersIdsByTeam('consultant');
        $this->cecs = $this->userService->getUsersIdsByTeam('cec');
    }

    /**
     * Les noms de nos clients fictifs
     * @var string[]
     */
    protected $names = [
        'My Company',
        'The World Is Mine',
        'Tomorrow',
        'Crazy Little Business',
        'Geronimo Inc.',
        'The Beatles',
        'Honolulu Forever',
        'Be Happy First',
        'Ellis In Wonderland',
        'Be The One',
        'One To Rule Them All',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        foreach ($this->names as $name) {

            // Client creation
            $id = DB::table('clients')->insertGetId([
                'name' => $name,
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);

            // Client relationship with users
            if ($id) {

                $common = [
                    'client_id' => $id,
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                ];

                // Le client doit être associé à un consultant et un CEC
                DB::table('client_user')->insert([
                    array_merge($common, ['user_id' => $this->consultants->random(1)[0]]),
                    array_merge($common, ['user_id' => $this->cecs->random(1)[0]]),
                ]);

            }
        }
    }

}
