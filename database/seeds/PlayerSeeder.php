<?php

use App\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(['Ouzt', 'Nathou', 'Pandalves', 'Yass'] as $username) {
            Player::firstOrCreate([
                'username'  => $username
            ])->save();
        }
    }
}
