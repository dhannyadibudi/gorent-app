<?php

namespace App\Repositories\Implementations;

use App\Models\Schedule;
use App\Repositories\Interfaces\ScheduleRepositoryInterface;

class ScheduleRepository
    extends BaseRepository
    implements ScheduleRepositoryInterface
{
    public function __construct(
        Schedule $model
    ) {
        $this->model = $model;
    }

    public function paginate(
        int $perPage = 10,
        ?string $courtId = null,
        ?string $date = null
    ) {
        return $this->model
            ->query()
            ->with([
                'court',
                'court.gor',
            ])
            ->when($courtId, function ($query) use ($courtId) {
                $query->where(
                    'court_id',
                    $courtId
                );
            })
            ->when($date, function ($query) use ($date) {
                $query->whereDate(
                    'schedule_date',
                    $date
                );
            })
            ->orderBy('schedule_date')
            ->orderBy('start_time')
            ->paginate($perPage)
            ->withQueryString();
    }
}