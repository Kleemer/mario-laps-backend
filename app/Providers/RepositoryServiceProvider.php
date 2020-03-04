<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repository\AuthRepository;
use App\Repository\AuthRepositoryInterface;
use App\Repository\SessionRepository;
use App\Repository\SessionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected const MAP_REPOSITORIES = [
        AuthRepositoryInterface::class => AuthRepository::class,
        SessionRepositoryInterface::class => SessionRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     * @todo associate the interface to the concrete repository dynamically
     */
    public function register()
    {
        // We want to make this more dynamic and smart...
        // getting the interface should always return its concrete class
        collect(self::MAP_REPOSITORIES)
            ->each(function ($concrete, $interface) {
                $this->app->singleton($interface, function ($app) use ($concrete) {
                    return $app[$concrete];
                });
            });
    }
}
