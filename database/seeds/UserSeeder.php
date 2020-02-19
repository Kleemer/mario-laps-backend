<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(['Ouzt', 'Nathou', 'Pandalves', 'Yass'] as $username) {
            User::firstOrCreate([
                'username'  => $username
            ])->save();
        }
    }
}
