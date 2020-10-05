<?php

declare(strict_types=1);

namespace App\Observers;

use App\MarioLap;

class MarioLapObserver
{

    /**
     * @param MarioLap $marioLap
     */
    public function deleting(MarioLap $marioLap): void
    {
        $marioLap
            ->rounds()
            ->each(function ($round) {
                $round->delete();
            });
    }
}
