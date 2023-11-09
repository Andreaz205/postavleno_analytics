<?php

namespace App\Providers;

use App\Contracts\Services\ClientServiceContract;
use App\Contracts\Services\UserServiceContract;
use App\Services\ClientService;
use App\Services\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @var array|string[]
     */
    public array $binds = [
        ClientServiceContract::class => ClientService::class,
        UserServiceContract::class => UserService::class,
    ];


    public function register(): void
    {
        collect($this->binds)->each(function (string $bind, string $repositoryContract) {
            $this->app->bind($repositoryContract, $bind);
        });
    }

    public function provides(): array
    {
        return array_keys($this->binds);
    }
}
