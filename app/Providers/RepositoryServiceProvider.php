<?php

namespace App\Providers;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider  implements DeferrableProvider
{
    /**
     * @var array<string,array{concrete:string,model:string}>
     */
    private array $binds = [
        UserRepositoryContract::class => [
            'concrete' => UserRepository::class,
            'model' => User::class
        ],
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        collect($this->binds)->each(function (array $bind, string $repositoryContract) {
            $this->app->bind($repositoryContract, function () use ($bind) {
                return new $bind['concrete']($bind['model']::getModel());
            });
        });
    }

    public function provides(): array
    {
        return array_keys($this->binds);
    }
}
