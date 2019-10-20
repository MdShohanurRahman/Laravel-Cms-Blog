<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'shohan.drmc@gmail.com')->first();

        if (!$user) {
            User::create([
                'role' => 'admin',
                'name' => 'shohan',
                'email' => 'shohan.drmc@gmail.com',
                'password' => Hash::make('password')
            ]);
        }
    }
}
