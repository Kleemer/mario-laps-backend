<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{

    public function testUserCanLogout()
    {
        $this->authUserPost(route('logout'))
            ->assertSuccessful();
    }

    public function testGuestCanLogin()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('password'),
        ]);

        $this->postJson(route('login'), [
            'username' => $user->username,
            'password' => 'password',
        ])
        ->assertSuccessful();
    }

    public function testGuestCannotLoginWithInexistantUsername()
    {
        $user = factory(User::class)->create([
            'username' => 'bulbasaur',
            'password' => bcrypt('password'),
        ]);

        $this->postJson(route('login'), [
            'username' => 'charmander',
            'password' => 'password',
        ])
        ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testGuestCannotLoginWithWrongPassword()
    {
        $user = factory(User::class)->create([
            'username' => 'bulbasaur',
            'password' => bcrypt('password'),
        ]);

        $this->postJson(route('login'), [
            'username' => 'bulbasaur',
            'password' => '1password1',
        ])
        ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
