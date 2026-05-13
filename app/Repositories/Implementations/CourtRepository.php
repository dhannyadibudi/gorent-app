<?php

namespace App\Repositories\Implementations;

use App\Models\Court;
use App\Repositories\Interfaces\CourtRepositoryInterface;

class CourtRepository
    extends BaseRepository
    implements CourtRepositoryInterface
{
    public function __construct(
        Court $model
    ) {
        $this->model = $model;
    }

    public function paginate(
        int $perPage = 10,
        ?string $search = null,
        ?string $gorId = null
    ) {
        return $this->model
            ->query()
            ->with('gor')
            ->when($search, function ($query) use ($search) {
                $query->where(
                    'name',
                    'ilike',
                    "%{$search}%"
                );
            })
            ->when($gorId, function ($query) use ($gorId) {

                $query->where(
                    'gor_id',
                    $gorId
                );

            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }
}