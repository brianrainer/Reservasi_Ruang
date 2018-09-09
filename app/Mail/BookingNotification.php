<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $technician;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($technician)
    {
        $this->technician = $technician;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('no-reply@reservasi.if.its.ac.id')
        ->to($this->technician->email)
        ->view('email');
    }
}
