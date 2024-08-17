<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Module;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;

//

class HomeController extends Controller
{
    public function index()
    {
        Gate::authorize('access-dashboard');
        $user_count = User::count();
        $role_count = Role::count();
        $page_count = Page::count();
        $module_count = Module::count();
        $users = User::with(['role'])->latest('id')->paginate();

        return view('admin.pages.dashboard', compact(
            'user_count',
            'role_count',
            'page_count',
            'module_count',
            'users'));

    }
}
