<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function getAll()
    {
        return $this->model
            ->latest()
            ->get();
    }

    public function paginate(
        int $perPage = 10
    ) {
        return $this->model
            ->latest()
            ->paginate($perPage);
    }

    public function findById(string $id)
    {
        return $this->model
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model
            ->create($data);
    }

    public function update(
        string $id,
        array $data
    ) {

        $model = $this->findById($id);

        $model->update($data);

        return $model;
    }

    public function delete(string $id)
    {
        return $this->findById($id)
            ->delete();
    }
}