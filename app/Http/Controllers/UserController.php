<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function store(RegisterRequest $registerRequest)
    {
        $request = $registerRequest->validated();

        $user = User::create([
            'username'      => $request['username'],
            'password'      => bcrypt($request['password']),
        ]);

        return new UserResource($user);
    }
}
