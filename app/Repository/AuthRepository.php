<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Cookie\CookieJar;
use Symfony\Component\HttpFoundation\Cookie;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * @var ConfigRepository
     */
    private $configRepository;
    /**
     * @var CookieJar
     */
    private $cookieJar;

    public function __construct(ConfigRepository $configRepository, CookieJar $cookieJar)
    {
        $this->configRepository = $configRepository;
        $this->cookieJar = $cookieJar;
    }


    public function getLoginCookie(string $token): Cookie
    {
        return $this->cookieJar->make(
            $this->configRepository->get('jwt.cookie.name'),
            $token,
            0, // Session Cookie
            null,
            null,
            (bool) $this->configRepository->get('jwt.cookie.secure'),
            true,
            false,
            $this->configRepository->get('jwt.cookie.sameSite')
        );
    }

    public function getLogoutCookie(): Cookie
    {
        return $this->cookieJar->forget($this->configRepository->get('jwt.cookie.name'));
    }
}
