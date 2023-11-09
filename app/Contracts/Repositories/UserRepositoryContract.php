<?php

namespace App\Contracts\Repositories;

use App\DTO\User\UploadUsersResponseDTO;

interface UserRepositoryContract
{
    public function createOrUpdate(array $usersFields, array $uniqueByFields, array $updateFields): array;

    public function getTotal(): int;
}
