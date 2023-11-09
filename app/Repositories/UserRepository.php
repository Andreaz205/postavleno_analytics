<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryContract
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function createOrUpdate(array $usersFields, array $uniqueByFields, array $updateFields): array
    {
        DB::beginTransaction();

        $uniqueFields = array_map(fn ($field) => $field['first_last'], $usersFields);

        $existsCount = $this->model->query()->whereIn('first_last', $uniqueFields)->count();

        $modifiedCount = $this->model->query()->upsert($usersFields, $uniqueByFields, $updateFields);

        DB::commit();

        return [
            $existsCount,
            $modifiedCount - $existsCount
        ];
    }

    public function getTotal(): int
    {
        return $this->model->query()->count();
    }
}
