<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role.view')->only(['index', 'show']);
        $this->middleware('permission:role.create')->only(['create', 'store']);
        $this->middleware('permission:role.edit')->only(['edit', 'update']);
        $this->middleware('permission:role.delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $perPage = in_array(request('per_page'), [10, 25, 50, 100]) ? request('per_page') : 10;
        $search  = trim((string) $request->input('q'));

        $roles = Role::with('permissions')
            ->when($search !== '', fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.roles.index', compact('roles', 'search'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy(fn ($p) => explode('.', $p->name)[0]);
        return view('pages.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $role = Role::create(['name' => $data['name'], 'guard_name' => 'web']);
        $role->syncPermissions($data['permissions'] ?? []);

        return redirect()->route('roles.index')->with('status', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(fn ($p) => explode('.', $p->name)[0]);
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('pages.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $role->update(['name' => $data['name']]);
        $role->syncPermissions($data['permissions'] ?? []);

        return redirect()->route('roles.index')->with('status', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if (in_array($role->name, ['Admin'])) {
            return back()->withErrors(['error' => 'Admin role cannot be deleted.']);
        }

        $role->delete();
        return redirect()->route('roles.index')->with('status', 'Role deleted successfully.');
    }
}
