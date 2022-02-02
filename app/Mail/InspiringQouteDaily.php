<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Inspiring;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InspiringQouteDaily extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Mirmengjesi , kaloni nje dite te bukur :)')
            ->view('email.inspiringQoute')->with([
                    'inspiringQoute' => Inspiring::quote()
            ]);
    }
}
