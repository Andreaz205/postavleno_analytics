<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

abstract class AbstractClientService
{

    /**
     * @throws \Exception
     */
    protected function handleException(\Exception $exception)
    {
        Log::error($exception->getMessage());

        throw new \Exception('Ошибка обращения к сервису пользователей!');
    }
}
