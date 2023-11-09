<?php

namespace App\DTO\User;

class UploadUsersResponseDTO
{
    /**
     * @var ResponseUserDTO[]
     */
    private array $users;


    /**
     * @return ResponseUserDTO[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param iterable<ResponseUserDTO> $users
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }
}
