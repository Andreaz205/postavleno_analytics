<?php

namespace App\DTO\User;

class ResponseUserDTO
{
    private string $email;

    /** @var ResponseUserNameDTO */
    private ResponseUserNameDTO $name;

    private ResponseUserDobDTO $dob;

    public function getName(): ResponseUserNameDTO
    {
        return $this->name;
    }

    public function setName(ResponseUserNameDTO $name): void
    {
        $this->name = $name;
    }

    public function getDob(): ResponseUserDobDTO
    {
        return $this->dob;
    }

    public function setDob(ResponseUserDobDTO $dob): void
    {
        $this->dob = $dob;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
