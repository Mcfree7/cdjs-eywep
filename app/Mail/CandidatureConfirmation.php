<?php

namespace App\Mail;

use App\Models\Candidature;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidatureConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly Candidature $candidature,
        public readonly Project $project,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre candidature — ' . $this->project->titre,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.candidature-confirmation',
            with: [
                'candidature' => $this->candidature,
                'project'     => $this->project,
            ],
        );
    }
}
