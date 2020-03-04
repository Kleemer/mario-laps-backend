<?php

namespace App\Rules;

use App\MarioLap;
use Illuminate\Contracts\Validation\Rule;

class RoundRule implements Rule
{
    public function passes($attribute, $value)
    {
        $marioLap = MarioLap::where('id', $value)->first();

        return !!$marioLap;
    }

    public function message()
    {
        return 'This Mario Lap is closed.';
    }
}
