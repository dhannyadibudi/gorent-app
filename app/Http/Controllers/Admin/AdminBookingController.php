<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminBookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService
    ) {}

    public function index(Request $request)
    {
        $bookings = Booking::query()
            ->with([
                'user',
                'schedule.court.gor',
                'payment'
            ])
            ->when(
                $request->status,
                fn ($q, $status) => $q->where('status', $status)
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return Inertia::render(
            'Admin/Bookings/Index',
            [
                'bookings' => $bookings,
                'filters' => [
                    'status' => $request->status
                ]
            ]
        );
    }

    public function show(Booking $booking)
    {
        $booking->load([
            'user',
            'court.gor',
            'payment'
        ]);

        return Inertia::render(
            'Admin/Bookings/Show',
            compact('booking')
        );
    }

    public function cancel(Booking $booking)
    {
        $this->bookingService->cancel($booking);

        return back()->with(
            'success',
            'Booking cancelled successfully.'
        );
    }

    public function complete(Booking $booking)
    {
        $this->bookingService->complete($booking);

        return back()->with(
            'success',
            'Booking completed successfully.'
        );
    }
}