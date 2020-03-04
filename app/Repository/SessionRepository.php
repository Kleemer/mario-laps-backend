<?php

declare(strict_types=1);

namespace App\Repository;

use App\Session;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SessionRepository implements SessionRepositoryInterface
{
    public function getActive(): Collection
    {
        return Session::where('created_at', '>', Carbon::now()->subHours(24))->get();
    }
}
