<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Contracts\View\View;

class TemplateController extends Controller
{
    public function index(): View
    {
        return view('templates.index', ['templates' => EmailTemplate::latest()->paginate(20)]);
    }
}
