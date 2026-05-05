<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:dashboard.view');
    }

    public function index()
    {
        $stats = [
            'users'       => User::count(),
            'roles'       => Role::count(),
            'permissions' => Permission::count(),
            'menus'       => Menu::where('is_active', true)->count(),
        ];

        // Recent users (last 5)
        $recentUsers = User::with('roles')->latest()->take(5)->get();

        // Role distribution: how many users in each role
        $roleDistribution = Role::withCount('users')
            ->orderByDesc('users_count')
            ->get()
            ->map(fn ($r) => [
                'name'  => $r->name,
                'count' => $r->users_count,
            ]);

        // Recent menu items added
        $recentMenus = Menu::with('parent')->latest()->take(5)->get();

        return view('pages.dashboard', compact(
            'stats', 'recentUsers', 'roleDistribution', 'recentMenus'
        ));
    }
}
