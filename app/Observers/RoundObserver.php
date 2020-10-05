<?php

declare(strict_types=1);

namespace App\Observers;

use App\Round;

class RoundObserver
{
    /**
     * @param Round $round
     */
    public function deleting(Round $round): void
    {
        $round
            ->races()
            ->each(function ($race) {
                $race->delete();
            });
    }
}
