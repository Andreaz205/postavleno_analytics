<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Services\ClientServiceContract;
use App\Contracts\Services\UserServiceContract;
use App\DTO\User\ResponseUserDTO;
use App\DTO\User\UploadUsersResponseDTO;

class UserService implements UserServiceContract
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
    public function handleUploadUsers()
    {
        /** @var UploadUsersResponseDTO $responseUsersDto */
        $responseUsersDto = app(ClientServiceContract::class)->fetchUsers();

        $fields = array_map(fn (ResponseUserDTO $user) => [
            'first_name' => $user->getName()->getFirst(),
            'last_name' => $user->getName()->getLast(),
            'email' => $user->getEmail(),
            'age' => $user->getDob()->getAge(),
            'first_last' => $user->getName()->getFirst() . "_" . $user->getName()->getLast(),
        ] , $responseUsersDto->getUsers());

        $fields = $this->deduplicate($fields);

        [$createdCount, $updatedCount] = $this->repository->createOrUpdate(
            $fields,
            ['first_last'],
            ['email', 'age']
        );

        return [$createdCount, $updatedCount];
    }

    private function deduplicate(array $fields): array
    {
        $result = [];

        foreach ($fields as $field) {
            $result[$field['first_last']] = $field;
        }

        return array_values($result);
    }

    public function total(): int
    {
        return $this->repository->getTotal();
    }
}
