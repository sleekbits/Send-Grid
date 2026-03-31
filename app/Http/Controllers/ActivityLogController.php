<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(): View
    {
        return view('activity.index', ['logs' => Activity::latest()->paginate(50)]);
    }
}
