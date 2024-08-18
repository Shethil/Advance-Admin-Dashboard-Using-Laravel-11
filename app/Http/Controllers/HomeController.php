<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Models\Module;
use App\Models\UserLoginHistory;
use Illuminate\Support\Facades\Gate;

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
        $loginhistory = UserLoginHistory::latest('id')->paginate();

        return view('admin.pages.dashboard', compact(
            'user_count',
            'role_count',
            'page_count',
            'module_count',
            'loginhistory'));

    }
}
