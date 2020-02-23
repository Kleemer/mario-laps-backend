<?php

namespace App\Http\Controllers;

use App\Repository\AuthRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Cookie\QueueingFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var QueueingFactory
     */
    private $queueingFactory;
    /**
     * @var AuthRepositoryInterface
     */
    private $authRepository;

    /**
     * AuthController constructor.
     * @param QueueingFactory $queueingFactory
     * @param AuthRepositoryInterface $authRepository
     */
    public function __construct(QueueingFactory $queueingFactory, AuthRepositoryInterface $authRepository) {
        $this->queueingFactory = $queueingFactory;
        $this->authRepository = $authRepository;
    }

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

            $this->queueingFactory->queue(
                $this->authRepository->getLoginCookie($accessToken)
            );

            return self::respondWithToken();
        }


        return response()
                ->make()
                ->setContent('Unauthorized')
                ->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $t) {
            // Token expired/blacklisted, but it's fine in this case. Don't throw an exception.
        }

        $this->queueingFactory->queue(
            $this->authRepository->getLogoutCookie()
        );

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
    protected function respondWithToken()
    {
        $content = [
            'data' => null,
        ];

        $jwt = JWTAuth::factory();
            $claims = $jwt->buildClaimsCollection();
            $content['data'] = [
                'exp' => Carbon::createFromTimeStamp($claims['exp']->getValue())->toIso8601ZuluString(),
                'iat' => Carbon::createFromTimeStamp($claims['iat']->getValue())->toIso8601ZuluString(),
                'ttl' => $jwt->getTTL() * 60 * 1000,
            ];

        return response()
            ->make()
            ->setContent($content)
            ->setStatusCode(Response::HTTP_OK);
    }
}
