<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $otp;

    /**
     * Create a new message instance.
     */
    public function __construct(string $otp)
    {
        $this->otp = $otp;
    }

    /**
     * Define the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your One-Time Password (OTP)',
        );
    }

    /**
     * Define the content of the message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.otp', // ✅ यो view path मा हुनु पर्छ: resources/views/emails/otp.blade.php
            with: [
                'otp' => $this->otp,
            ],
        );
    }

    /**
     * Define any attachments if needed (empty in this case).
     */
    public function attachments(): array
    {
        return [];
    }
}
