<?php

namespace App\DTO\User;

class ResponseUserNameDTO
{
    private string $first;
    private string $last;

    public function getFirst(): string
    {
        return $this->first;
    }

    public function setFirst(string $first): void
    {
        $this->first = $first;
    }

    public function getLast(): string
    {
        return $this->last;
    }

    public function setLast(string $last): void
    {
        $this->last = $last;
    }
}
