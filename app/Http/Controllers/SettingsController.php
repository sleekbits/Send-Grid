<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    public function system(): View { return view('settings.system'); }
    public function mail(): View { return view('settings.mail'); }
    public function updateSystem(): RedirectResponse { return back()->with('success', 'System settings updated'); }
    public function updateMail(): RedirectResponse { return back()->with('success', 'Mail settings updated'); }
    public function testMail(): RedirectResponse { return back()->with('success', 'Test email queued'); }
}
