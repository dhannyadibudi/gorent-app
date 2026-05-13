<?php

namespace App\Repositories\Interfaces;

interface ScheduleRepositoryInterface
{
    public function paginate(
        int $perPage = 10,
        ?string $courtId = null,
        ?string $date = null
    );
}