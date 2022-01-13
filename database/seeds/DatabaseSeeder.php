<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Database\Seeders\App\UsersSeeder::class);
        $this->call(\Database\Seeders\App\ClientsSeeder::class);
        $this->call(\Database\Seeders\App\ProjetsSeeder::class);
        $this->call(\Database\Seeders\App\ContratsSeeder::class);
        $this->call(\Database\Seeders\App\InterventionsSeeder::class);
    }
}
