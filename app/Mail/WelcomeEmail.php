<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user; // Pass the user to the class
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Welcome to Our Website!')
                    ->view('emails.welcome'); // This will refer to the welcome.blade.php email view
    }

}
