<?php

namespace App\Repositories\Interfaces;

interface CourtRepositoryInterface
{
    public function paginate(
        int $perPage = 10,
        ?string $search = null,
        ?string $gorId = null
    );
}