<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public $user;

    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
        //     return $next($request);
        // });
    }


    public function index()
    {
        $total_roles = count(Role::select('id')->get());
        $total_admins = count(User::select('id')->get());
        // $total_admins = 0;
        $total_permissions = count(Permission::select('id')->get());
        return view('backend.pages.dashboard.index', compact('total_admins', 'total_roles', 'total_permissions'));
    }
}
