<?php

namespace App\Repositories\Interfaces;

interface GorRepositoryInterface
{
    public function paginateWithFilter(
        int $perPage = 10,
        ?string $search = null,
        ?bool $isActive = null
    );
}