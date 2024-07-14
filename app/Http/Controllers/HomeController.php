<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

//

class HomeController extends Controller
{
    public function index()
    {
        Gate::authorize('access-dashboard');
        return view('admin.pages.dashboard');
    }
}
