<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpiryMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $array;

    public function __construct($array)
    {
        $this->array = $array;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->array['from'])
                    ->markdown('emails.expiry')
                    ->subject($this->array['subject'])
                    // ->view($this->array['view'])
                    ->with([
                        'details' => $this->array['details'] ,
                        'seller' => $this->array['seller'] ,
                        ]);
    }
}
