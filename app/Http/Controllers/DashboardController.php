<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Contact;
use App\Models\EmailLog;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $kpis = [
            'total_contacts' => Contact::count(),
            'total_campaigns' => Campaign::count(),
            'total_emails_sent' => EmailLog::where('status', 'sent')->count(),
            'delivered_emails' => EmailLog::where('status', 'delivered')->count(),
            'failed_emails' => EmailLog::where('status', 'failed')->count(),
            'open_rate' => (float) EmailLog::whereNotNull('opened_at')->count(),
            'click_rate' => (float) EmailLog::whereNotNull('clicked_at')->count(),
            'unsubscribed_count' => Contact::where('status', 'unsubscribed')->count(),
        ];

        return view('dashboard.index', [
            'kpis' => $kpis,
            'latestCampaigns' => Campaign::latest()->take(5)->get(),
            'scheduledCampaigns' => Campaign::where('status', 'scheduled')->latest()->take(5)->get(),
            'failedJobs' => EmailLog::where('status', 'failed')->latest()->take(10)->get(),
        ]);
    }
}
