<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceContract;
use App\Http\Resources\User\UploadResource;

class UserController extends Controller
{
    private UserServiceContract $service;

    public function __construct(UserServiceContract $service)
    {
        $this->service = $service;
    }

    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Index', [
            'total' => $this->service->total()
        ]);
    }

    public function upload(): array
    {
        [$createdCount, $updatedCount] = $this->service->handleUploadUsers();

        return UploadResource::make([
            'created' => $createdCount,
            'updated' => $updatedCount,
            'total'   => $this->service->total()
        ])->resolve();
    }
}
