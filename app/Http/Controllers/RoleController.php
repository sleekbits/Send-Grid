<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        return view('roles.index', ['roles' => Role::query()->paginate(20)]);
    }
}
