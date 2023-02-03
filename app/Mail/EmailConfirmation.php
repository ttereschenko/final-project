<?php

namespace App\Mail;

use App\Models\User;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class EmailConfirmation extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private User $user)
    {
        //
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Please, confirm your email',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        $ttl = new DateTime();
        $ttl->modify('1 hour');
        $link = URL::temporarySignedRoute(
            'verify.email',
            $ttl,
            [
                'id' => $this->user->id,
                'hash' => sha1($this->user->email),
            ]
        );

        return new Content(
            view: 'emails.email_confirmation',
            with: [
                'name' => $this->user->name,
                'link' => $link,
            ],
        );
    }
}
