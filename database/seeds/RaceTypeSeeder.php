<?php

use App\RaceType;
use Illuminate\Database\Seeder;

class RaceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        collect(RaceType::TYPES)->each(function ($type) {
            RaceType::firstOrCreate([
                'id' => $type['id'],
                'name' => $type['name'],
            ])->save();
        });
    }
}
