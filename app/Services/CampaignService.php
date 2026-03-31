<?php

namespace App\Services;

use App\Jobs\ProcessCampaignSend;
use App\Mail\CampaignTestMail;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CampaignService
{
    public function sendTest(Campaign $campaign, User $user): void
    {
        Mail::to($user->email)->queue(new CampaignTestMail($campaign));
    }

    public function queueSend(Campaign $campaign): void
    {
        ProcessCampaignSend::dispatch($campaign->id);
    }

    public function duplicate(Campaign $campaign): Campaign
    {
        return $campaign->replicate()->fill([
            'name' => $campaign->name . ' (Copy)',
            'status' => 'draft',
        ])->tap(fn ($copy) => $copy->save());
    }
}
