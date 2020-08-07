<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class MayoristaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
   
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $datos)
    {
        $this->datos = $datos;     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build($datos)
    {
        return $this->view('email.mayoristare');
    }
}
