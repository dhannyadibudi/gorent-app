<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Gor;
use App\Models\User;
use App\Models\Court;
use App\Models\Booking;
use App\Models\Payment;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Payment::query()
            ->where(
                'status',
                'paid'
            )
            ->sum('amount');

        $recentBookings = Booking::query()
            ->with([
                'user',
                'schedule.court.gor',
                'payment',
            ])
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render(
            'Admin/Dashboard',
            [
                'stats' => [
                    'total_users' => User::count(),
                    'total_gors' => Gor::count(),
                    'total_courts' => Court::count(),
                    'total_bookings' => Booking::count(),
                    'pending_payments' => Payment::where(
                        'status',
                        'pending'
                    )->count(),
                    'total_revenue' => $totalRevenue,
                ],

                'recentBookings' => $recentBookings,
            ]
        );
    }
}