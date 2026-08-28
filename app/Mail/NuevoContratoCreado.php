<?php

namespace App\Mail;

use App\Models\Contrato;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NuevoContratoCreado extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Contrato $contrato)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo Contrato Creado - ' . $this->contrato->folio,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.nuevo-contrato-creado',
            with: [
                'contrato' => $this->contrato,
                'tramitante' => $this->contrato->tramitante,
                'folio' => $this->contrato->folio,
                'estado' => $this->contrato->estado,
                'fechaCreacion' => $this->contrato->created_at->format('d/m/Y H:i:s'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
