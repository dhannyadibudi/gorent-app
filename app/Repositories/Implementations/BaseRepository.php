<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function getAll()
    {
        return $this->model
            ->latest()
            ->get();
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

    public function update(string $id, array $data)
    {
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