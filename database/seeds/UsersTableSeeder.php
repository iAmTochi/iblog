<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'ugwukelvintochukwu@gmail.com')->first();

        if(!$user){
            User::create([
                'name' => 'Tochukwu Ugwu',
                'role' => 'admin',
                'email' => 'ugwukelvintochukwu@gmail.com',
                'password' => Hash::make('11111111'),

            ]);
        }
    }
}
