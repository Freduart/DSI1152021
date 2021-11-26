<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreossInstitucionMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    
    //public $subject = "Confirmacion de peticion de Servicio Social";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmacion de solicitud para servicio social')->view('emails.correossinstitucion');
    }
}
