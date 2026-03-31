<?php

namespace App\Mail;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class CampaignTestMail extends Mailable
{
    use Queueable;

    public function __construct(private readonly Campaign $campaign) {}

    public function build(): self
    {
        return $this->subject('[TEST] ' . $this->campaign->subject)->view('emails.test', ['campaign' => $this->campaign]);
    }
}
