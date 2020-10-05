<?php

namespace App\Providers;

use App\MarioLap;
use App\Observers\MarioLapObserver;
use App\Observers\RaceObserver;
use App\Observers\RoundObserver;
use App\Race;
use App\Round;
use Illuminate\Support\ServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        MarioLap::observe(MarioLapObserver::class);
        Round::observe(RoundObserver::class);
        Race::observe(RaceObserver::class);
    }
}
