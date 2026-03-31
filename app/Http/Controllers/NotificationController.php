<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    public function index(): View
    {
        return view('notifications.index', ['notifications' => auth()->user()->notifications]);
    }

    public function markRead(string $notification): RedirectResponse
    {
        auth()->user()->notifications()->whereKey($notification)->update(['read_at' => now()]);

        return back();
    }
}
