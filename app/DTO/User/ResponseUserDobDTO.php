<?php

namespace App\DTO\User;

class ResponseUserDobDTO
{
    private int $age;

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }
}
