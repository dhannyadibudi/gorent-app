<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Booking $booking
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Booking Created')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your booking has been created successfully.')
            ->line('Invoice: ' . $this->booking->invoice_number)
            ->line('Total: Rp ' . number_format($this->booking->total_price))
            ->action(
                'View Booking',
                url('/customer/bookings/' . $this->booking->id)
            )
            ->line('Thank you for using GoRent.');
    }
}