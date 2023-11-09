<?php

namespace App\Contracts\Services;

interface UserServiceContract
{
    public function handleUploadUsers();

    public function total(): int;
}
