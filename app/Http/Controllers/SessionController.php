<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\SessionResource;
use App\Repository\SessionRepositoryInterface;

class SessionController extends Controller
{
    /**
     * @deprecated
     * @var SessionRepositoryInterface
     */
    private $repository;

    public function __construct(SessionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return SessionResource::collection(
            $this
                ->repository
                ->getActive()
                ->load(['rounds'])
        );
    }
}
