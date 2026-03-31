<?php

namespace App\Mail;

use App\Models\Campaign;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class CampaignBulkMail extends Mailable
{
    use Queueable;

    public function __construct(private readonly Campaign $campaign, private readonly Contact $contact) {}

    public function build(): self
    {
        return $this->subject($this->campaign->subject)
            ->view('emails.bulk', ['campaign' => $this->campaign, 'contact' => $this->contact]);
    }
}
