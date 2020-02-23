<?php

declare(strict_types=1);

namespace App\Repository;

use Symfony\Component\HttpFoundation\Cookie;

interface AuthRepositoryInterface
{
    public function getLoginCookie(string $token): Cookie;

    public function getLogoutCookie(): Cookie;
}
