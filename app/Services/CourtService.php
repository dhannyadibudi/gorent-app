<?php

namespace App\Services;

use App\Repositories\Interfaces\CourtRepositoryInterface;

class CourtService
{
    public function __construct(
        protected CourtRepositoryInterface $courtRepository
    ) {}

    public function paginate(
        int $perPage = 10,
        ?string $search = null,
        ?string $gorId = null
    ) {

        return $this->courtRepository
            ->paginate(
                $perPage,
                $search,
                $gorId
            );
    }

    public function findById(string $id)
    {
        return $this->courtRepository
            ->findById($id);
    }

    public function create(array $data)
    {
        return $this->courtRepository
            ->create($data);
    }

    public function update(
        string $id,
        array $data
    ) {

        return $this->courtRepository
            ->update($id, $data);
    }

    public function delete(string $id)
    {
        return $this->courtRepository
            ->delete($id);
    }
}