<?php

namespace App\Jobs;

use App\Mail\CampaignBulkMail;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\EmailLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessCampaignSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public function __construct(public int $campaignId)
    {
    }

    public function handle(): void
    {
        $campaign = Campaign::findOrFail($this->campaignId);
        if (in_array($campaign->status, ['paused', 'failed'], true)) {
            return;
        }

        $campaign->update(['status' => 'processing']);

        Contact::where('status', 'active')->chunkById(500, function ($contacts) use ($campaign): void {
            foreach ($contacts as $contact) {
                $existing = EmailLog::where('campaign_id', $campaign->id)->where('contact_id', $contact->id)->exists();
                if ($existing) {
                    continue;
                }

                Mail::to($contact->email)->queue(new CampaignBulkMail($campaign, $contact));
                EmailLog::create([
                    'campaign_id' => $campaign->id,
                    'contact_id' => $contact->id,
                    'status' => 'sent',
                    'provider' => 'smtp',
                ]);
            }
        });

        $campaign->update(['status' => 'sent']);
        activity()->event('campaign.sent')->performedOn($campaign)->log('Campaign sent');
    }
}
