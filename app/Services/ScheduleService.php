<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Court;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ScheduleRepositoryInterface;

class ScheduleService
{
    public function __construct(
        protected ScheduleRepositoryInterface $scheduleRepository
    ) {}

    public function paginate(
        int $perPage = 10,
        ?string $courtId = null,
        ?string $date = null
    ) {

        return $this->scheduleRepository
            ->paginate(
                $perPage,
                $courtId,
                $date
            );
    }

    public function generate(
        Court $court,
        string $date
    ) {

        return DB::transaction(function () use (
            $court,
            $date
        ) {
            $start = Carbon::parse(
                $court->open_time
            );

            $end = Carbon::parse(
                $court->close_time
            );

            $generated = [];

            while ($start < $end) {
                $slotStart = $start->format('H:i:s');
                $slotEnd = $start
                    ->copy()
                    ->addHour()
                    ->format('H:i:s');

                if (
                    Carbon::parse($slotEnd)
                    > Carbon::parse($court->close_time)
                ) {
                    break;
                }

                $schedule = Schedule::firstOrCreate(
                    [
                        'court_id' => $court->id,
                        'schedule_date' => $date,
                        'start_time' => $slotStart,
                        'end_time' => $slotEnd,
                    ],
                    [
                        'is_booked' => false,
                    ]
                );
                $generated[] = $schedule;
                $start->addHour();
            }

            return $generated;
        });
    }
}