<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\MarioLapResource;
use App\Repository\MarioLapRepositoryInterface;

class MarioLapController extends Controller
{
    /**
     * @deprecated
     * @var MarioLapRepositoryInterface
     */
    private $repository;

    public function __construct(MarioLapRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return MarioLapResource::collection(
            $this
                ->repository
                ->getActive()
                ->load(['rounds'])
        );
    }
}
