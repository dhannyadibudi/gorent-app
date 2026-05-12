<?php

namespace App\Repositories\Implementations;

use App\Models\Gor;
use App\Repositories\Interfaces\GorRepositoryInterface;

class GorRepository
    extends BaseRepository
    implements GorRepositoryInterface
{
    public function __construct(
        Gor $model
    ) {
        $this->model = $model;
    }

    public function paginateWithFilter(
        int $perPage = 10,
        ?string $search = null,
        ?bool $isActive = null
    ) {

        return $this->model
            ->query()

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'name',
                        'ilike',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'address',
                        'ilike',
                        "%{$search}%"
                    );

                });

            })

            ->when(
                !is_null($isActive),
                fn ($query) => $query->where(
                    'is_active',
                    $isActive
                )
            )

            ->latest()

            ->paginate($perPage)

            ->withQueryString();
    }
}