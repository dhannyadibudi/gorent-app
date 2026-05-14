<?php

namespace App\Http\Controllers\Customer;

use App\Models\Court;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\BookingService;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService
    ) {}

    public function index()
    {
        $bookings = auth()
            ->user()
            ->bookings()
            ->with([
                'payment',
                'schedule.court.gor',
            ])
            ->latest()
            ->paginate(10);

        return inertia(
            'Customer/Booking/Index',
            [
                'bookings' => $bookings,
            ]
        );
    }

    public function create(
        Request $request,
        string $courtId
    ) {

        $court = Court::query()
            ->with([
                'gor',
                'schedules' => function ($query) use ($request) {
                    $query->when(
                        $request->date,
                        fn ($q) =>
                        $q->whereDate(
                            'schedule_date',
                            $request->date
                        )
                    )
                    ->orderBy('start_time');
                }
            ])
            ->findOrFail($courtId);

        return Inertia::render(
            'Customer/Booking/Create',
            [
                'court' => $court,

                'selectedDate' =>
                    $request->date,
            ]
        );
    }

    public function store(
        Request $request
    ) {

        $request->validate([
            'schedule_id' => [
                'required',
                'exists:schedules,id',
            ],
        ]);

        $result = $this->bookingService
            ->create(
                auth()->user(),
                $request->schedule_id
            );

        return redirect(
            $result['payment']['redirect_url']
        );
    }
}