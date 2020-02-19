<?php

namespace App;

use App\Http\Controllers\Concern\UuidAsPrimary;
use Illuminate\Database\Eloquent\Model;

class UserRace extends Model
{
    use UuidAsPrimary;
}
