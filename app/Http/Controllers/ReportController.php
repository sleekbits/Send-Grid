<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Contracts\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        return view('reports.index', ['campaigns' => Campaign::withCount('emailLogs')->paginate(20)]);
    }
}
