<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Janji Temu Anda Ditolak',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment_rejected',
            with: [
                'appointment' => $this->appointment
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
