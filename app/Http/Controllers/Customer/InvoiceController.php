<?php

namespace App\Http\Controllers\Customer;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function download(
        Booking $booking
    ) {

        $booking->load([
            'user',
            'payment',
            'schedule.court.gor',
        ]);

        abort_if(
            $booking->user_id !== auth()->id(),
            403
        );

        $pdf = Pdf::loadView(
            'pdf.invoice',
            [
                'booking' => $booking,
            ]
        );

        return $pdf->download(
            "{$booking->invoice_number}.pdf"
        );
    }
}