<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class correos extends Mailable
{
    use Queueable, SerializesModels;
     public $subject='Reestablecer contraseña';
     public $codigo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($codigo)
    {
    $this->codigo=$codigo;
    }


    public function build()
    {
        return $this->view('correo')->with('codigo','12');
    }
}
