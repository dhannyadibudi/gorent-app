<?php

namespace App\Http\Controllers\Admin;

use App\Models\Court;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\ScheduleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\GenerateScheduleRequest;

class ScheduleController extends Controller
{
    public function __construct(
        protected ScheduleService $scheduleService
    ) {}

    public function index(Request $request)
    {
        return Inertia::render(
            'Admin/Schedule/Index',
            [
                'schedules' => $this->scheduleService
                    ->paginate(
                        perPage: 20,
                        courtId: $request->court_id,
                        date: $request->date
                    ),

                'courts' => Court::query()
                    ->with('gor')
                    ->get(),

                'filters' => [
                    'court_id' => $request->court_id,
                    'date' => $request->date,
                ]
            ]
        );
    }

    public function store(
        GenerateScheduleRequest $request
    ) {

        $court = Court::findOrFail(
            $request->court_id
        );

        $this->scheduleService
            ->generate(
                $court,
                $request->schedule_date
            );

        return redirect()
            ->back()
            ->with(
                'success',
                'Schedule generated successfully'
            );
    }
}