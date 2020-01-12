<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class UsersTest extends TestCase
{
    public function testGetUsers()
    {
        factory(User::class, 5)->create();
        $this->authUserGet(route('get.users'))
            ->assertSuccessful();
    }

    public function testPostUser()
    {
        $this->postJson(
            route('register'),
            [
                'username' => 'bulbasaur',
                'password' => 'password',
                'password_confirm' => 'password',
            ]
        )
            ->assertSuccessful();
    }

    /**
    * @dataProvider invalidUsernameDataProvider
    */
    public function testPostUserFailIfInvalidUsername($username)
    {
        $this->postJson(
            route('register'),
            [
                'username' => $username,
                'password' => 'password',
                'password_confirm' => 'password',
            ]
        )
            ->assertJsonValidationErrors([
                'username'
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function invalidUsernameDataProvider()
    {
        return [
            ['a'],
            [str_repeat('a', 61)],
        ];
    }

    public function testPostUserFailIfUsernameAlreadyUsed()
    {
        factory(User::class)->create([
            'username' => 'bulbasaur'
        ]);

        $this->postJson(
            route('register'),
            [
                'username' => 'bulbasaur',
                'password' => 'password',
                'password_confirm' => 'password',
            ]
        )
            ->assertJsonValidationErrors([
                'username'
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
    * @dataProvider invalidPasswordDataProvider
    */
    public function testPostUserFailIfInvalidPassword($password)
    {
        $this->postJson(
            route('register'),
            [
                'username' => 'bulbasaur',
                'password' => $password,
                'password_confirm' => 'password',
            ]
        )
            ->assertJsonValidationErrors([
                'password'
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function invalidPasswordDataProvider()
    {
        return [
            [str_repeat('a', 5)],
            [str_repeat('a', 31)],
        ];
    }

    public function testPostUserFailIfInvalidPasswordConfirm()
    {
        $this->postJson(
            route('register'),
            [
                'username' => 'bulbasaur',
                'password' => 'password',
                'password_confirm' => '1password1',
            ]
        )
            ->assertJsonValidationErrors([
                'password_confirm'
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
