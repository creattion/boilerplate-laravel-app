<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\CompanyInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class InviteUserToCompanyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $email, public CompanyInvitation $companyInvitation) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->email,
            subject: "Convite para empresa {$this->companyInvitation->company->name}",
        );
    }

    public function content(): Content
    {
        $url = URL::signedRoute('users.invitations.accept', [
            'invitation' => $this->companyInvitation,
        ]);

        return new Content(
            view: 'emails.invite-user-to-company',
            with: [
                'company' => $this->companyInvitation->company,
                'url' => $url,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
