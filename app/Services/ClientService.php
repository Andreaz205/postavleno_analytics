<?php

namespace App\Services;

use App\Contracts\Services\ClientServiceContract;
use App\DTO\User\UploadUsersResponseDTO;
use App\Library\Serializer\Serializer;
use Illuminate\Support\Facades\Http;

class ClientService extends AbstractClientService implements ClientServiceContract
{
    public function fetchUsers()
    {
        try {
            $response = Http::get('https://randomuser.me/api/?results=5000');

            $serializer = new Serializer();


            $usersData = json_decode($response->body(), true)['results'];

            return $serializer->fromArray(
                ['users' => $usersData],
                UploadUsersResponseDTO::class
            );
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }
    }
}
