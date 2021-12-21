<?php

use App\UserMeta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    protected $users = [
        [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'team' => 'web',
            'email' => 'johndoe@example.com',
            'password' => 'johndoe', // pour la démo
        ],
        [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'team' => 'cec',
            'email' => 'johnsmith@example.com',
            'password' => 'johnsmith', // pour la démo
        ],
        [
            'first_name' => 'Mickey',
            'last_name' => 'Mouse',
            'team' => 'consultant',
        ],
        [
            'first_name' => 'Harry',
            'last_name' => 'Potter',
            'team' => 'cec',
        ],
        [
            'first_name' => 'Iron',
            'last_name' => 'Man',
            'team' => 'consultant',
        ],
        [
            'first_name' => 'Frodo',
            'last_name' => 'Baggins',
            'team' => 'cec',
        ],
        [
            'first_name' => 'Gaston',
            'last_name' => 'Lagaffe',
            'team' => 'consultant',
        ],
        [
            'first_name' => 'Michel',
            'last_name' => 'Vaillant',
            'team' => 'consultant',
        ],
        [
            'first_name' => 'Luke',
            'last_name' => 'Skywalker',
            'team' => 'consultant',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->users as $key => &$userMeta) {

            /*
             * Check user data
             */
            if( !isset($userMeta['first_name']) || !isset($userMeta['last_name']) || !isset($userMeta['team']) || !in_array($userMeta['team'], UserMeta::$teams) ) {
                unset($this->users[$key]);
                continue;
            }

            /*
             * Prepare user info
             */
            $username = Str::slug("{$userMeta['first_name']}{$userMeta['last_name']}", "");

            if( isset($userMeta['email']) ) {
                $email = $userMeta['email'];
                unset($userMeta['email']);
            }
            else {
                $email = "$username@example.com";
            }

            if( isset($userMeta['password']) ) {
                $password = $userMeta['password'];
                unset($userMeta['password']);
            }
            else {
                $password = Str::random(10);
            }

            /*
             * DB requests
             */
            $carbon =  \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $userData = [
                'name' => $username,
                'email' => $email,
                'password' => Hash::make($password),
                'updated_at' => $carbon,
            ];

            // Email must be unique, so we might need to override old data
            if( $user = DB::table('users')->select("id")->where('email', '=', $email)->first() ) {
                $user_id = $user->id;
                DB::table('users')->where('id', '=', $user_id)->update($userData);
            }

            // Else, create a whole new user
            $userData['created_at'] = $carbon;
            $user_id = $user_id ?? DB::table('users')->insertGetId($userData);

            // Then insert/update user_meta
            if( $user_id ) {
                DB::table('user_meta')
                    ->where('user_id', '=', $user_id)
                    ->updateOrInsert($userMeta);
            }

        }
    }
}
