<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Jobs\ProcessCampaignSend;
use App\Models\Campaign;
use App\Services\CampaignService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CampaignController extends Controller
{
    public function __construct(private readonly CampaignService $campaignService)
    {
    }

    public function index(): View
    {
        return view('campaigns.index', [
            'campaigns' => Campaign::latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('campaigns.create');
    }

    public function store(CampaignRequest $request): RedirectResponse
    {
        $campaign = Campaign::create($request->validated());
        activity()->event('campaign.created')->performedOn($campaign)->log('Campaign created');

        return redirect()->route('campaigns.index')->with('success', 'Campaign created');
    }

    public function update(CampaignRequest $request, Campaign $campaign): RedirectResponse
    {
        $campaign->update($request->validated());

        return back()->with('success', 'Campaign updated');
    }

    public function destroy(Campaign $campaign): RedirectResponse
    {
        $campaign->delete();

        return back()->with('success', 'Campaign removed');
    }

    public function sendTest(Campaign $campaign): RedirectResponse
    {
        $this->campaignService->sendTest($campaign, auth()->user());

        return back()->with('success', 'Test email queued');
    }

    public function duplicate(Campaign $campaign): RedirectResponse
    {
        $this->campaignService->duplicate($campaign);

        return back()->with('success', 'Campaign duplicated');
    }

    public function pause(Campaign $campaign): RedirectResponse
    {
        $campaign->update(['status' => 'paused']);

        return back()->with('success', 'Campaign paused');
    }

    public function resume(Campaign $campaign): RedirectResponse
    {
        $campaign->update(['status' => 'processing']);
        ProcessCampaignSend::dispatch($campaign->id);

        return back()->with('success', 'Campaign resumed');
    }
}
