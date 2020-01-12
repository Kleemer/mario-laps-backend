<?php

declare(strict_types=1);

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @var User $authUser */
    private $authUser = null;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        Artisan::call('passport:install');
    }

    public function getAuthUser()
    {
        if (!$this->authUser) {
            $this->setAuthUser();
        }

        Passport::actingAs($this->authUser, []);
        return $this->authUser;
    }

    private function setAuthUser()
    {
        // Generate OAuth clients
        Artisan::call('passport:install');

        // Create the user
        $this->authUser = factory(User::class)->create([
            'username' => 'bulbasaur',
            'password' => bcrypt('password'),
        ]);
    }

    protected function authUserGet($uri)
    {
        $this->getAuthUser();

        $headers = [ 'Accept' => 'application/json' ];

        return $this->getJson($uri, $headers);
    }

    protected function authUserPost($uri, $parameters = [])
    {
        $this->getAuthUser();

        $headers = [
            'Accept' => 'application/json',
        ];

        return $this->postJson($uri, $parameters, $headers);
    }

    protected function authUserPut($uri, $parameters = [])
    {
        $this->getAuthUser();

        $headers = [
            'Accept' => 'application/json',
        ];

        return $this->putJson($uri, $parameters, $headers);
    }

    protected function authUserPatch($uri, $parameters = [])
    {
        $this->getAuthUser();

        $headers = [
            'Accept' => 'application/json',
        ];

        return $this->patchJson($uri, $parameters, $headers);
    }

    protected function authUserDelete($uri, $parameters = [])
    {
        $this->getAuthUser();

        $headers = [
            'Accept' => 'application/json',
        ];

        return $this->deleteJson($uri, $parameters, $headers);
    }
}
