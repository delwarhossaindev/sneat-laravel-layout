<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AssignPermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permission.assign');
    }

    public function index()
    {
        $roles = Role::with('permissions')->orderBy('name')->get();
        $users = User::with(['roles', 'permissions'])->orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get()
            ->groupBy(fn ($p) => explode('.', $p->name)[0]);

        return view('pages.assign-permissions.index', compact('roles', 'users', 'permissions'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'matrix'         => ['array'],
            'matrix.*'       => ['array'],
            'matrix.*.*'     => ['exists:permissions,name'],
            'user_matrix'    => ['array'],
            'user_matrix.*'  => ['array'],
            'user_matrix.*.*'=> ['exists:permissions,name'],
        ]);

        // Role-wise sync
        $roleMatrix = $request->input('matrix', []);
        foreach (Role::all() as $role) {
            $role->syncPermissions($roleMatrix[$role->id] ?? []);
        }

        // User-wise direct permission sync
        $userMatrix = $request->input('user_matrix', []);
        foreach (User::all() as $user) {
            $user->syncPermissions($userMatrix[$user->id] ?? []);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()->route('assign-permissions.index')
            ->with('status', 'Permissions assigned successfully.');
    }
}
