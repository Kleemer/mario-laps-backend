<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed maxAttempts
 * @property mixed decayMinutes
 */
class AuthController extends Controller
{
    /**
     * @return string
     */
    public function username(): string
    {
        return 'username';
    }

    /**
     * @param Request $request
     * @return Response|null
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $accessToken = Auth::user()->createToken('authToken')->accessToken;

            return self::respondWithToken($accessToken)
                ->setStatusCode(Response::HTTP_OK);
        }


        return response()
                ->make()
                ->setContent('Unauthorized')
                ->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }

    public function logout()
    {
        Auth::user()->token()->revoke();

        return response()
            ->make()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
}
