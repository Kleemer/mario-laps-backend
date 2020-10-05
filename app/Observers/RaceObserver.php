<?php

declare(strict_types=1);

namespace App\Observers;

use App\Race;

class RaceObserver
{
    /**
     * @param Race $round
     */
    public function deleting(Race $race): void
    {
        $race
            ->users()
            ->each(function ($user) {
                $user->delete();
            });
    }
}
