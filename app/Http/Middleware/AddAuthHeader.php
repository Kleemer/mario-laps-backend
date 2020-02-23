<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Http\Request;

class AddAuthHeader
{
    private $configRepo;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepo = $configRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If a bearer token has been provided, do nothing.
        if ($request->bearerToken()) {
            return $next($request);
        }

        // Convert the authentication cookie into a Bearer token header
        $token = null;
        $cookieName = $this->configRepo->get('jwt.cookie.name');

        if ($request->hasCookie($cookieName)) {
            $token = $request->cookie($cookieName);
        }

        if ($token) {
            $request->headers->add(['Authorization' => 'Bearer ' . $token]);
        }

        return $next($request);
    }
}
