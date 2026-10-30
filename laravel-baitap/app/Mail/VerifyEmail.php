<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    public function __construct($name = '')
    {
        $this->name = $name;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Xác thực tài khoản',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.verify', // Đã đổi thành mail.verify cho đúng thư mục resources/views/mail/
        );
    }

    public function attachments(): array
    {
        return [];
    }
}