<?php

declare(strict_types=1);

namespace App\Repository;

use App\MarioLap;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class MarioLapRepository implements MarioLapRepositoryInterface
{
    public function getActive(): Collection
    {
        return MarioLap::where('created_at', '>', Carbon::now()->subHours(24))->get();
    }
}
