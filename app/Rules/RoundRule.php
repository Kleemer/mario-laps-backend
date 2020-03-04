<?php

namespace App\Rules;

use App\Session;
use Illuminate\Contracts\Validation\Rule;

class RoundRule implements Rule
{
    public function passes($attribute, $value)
    {
        $session = Session::where('id', $value)->first();

        return !!$session;
    }

    public function message()
    {
        return 'This session is closed.';
    }
}
