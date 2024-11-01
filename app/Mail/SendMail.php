<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;

    public function __construct(Order $pedido)
    {
        $this->pedido = $pedido;
    }

    public function build()
    {
        return $this->view('emails.pedido_criado')
                    ->subject('Seu pedido foi criado com sucesso')
                    ->with(['pedido' => $this->pedido]);
    }
}
