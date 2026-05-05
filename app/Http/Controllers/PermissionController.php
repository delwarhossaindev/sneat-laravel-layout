<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permission.view')->only(['index']);
        $this->middleware('permission:permission.create')->only(['create', 'store']);
        $this->middleware('permission:permission.edit')->only(['edit', 'update']);
        $this->middleware('permission:permission.delete')->only(['destroy']);
    }

    public function index()
    {
        $perPage = in_array(request('per_page'), [10, 25, 50, 100]) ? request('per_page') : 10;
        $permissions = Permission::orderBy('name')->paginate($perPage);
        return view('pages.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('pages.permissions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name'],
        ]);

        Permission::create(['name' => $data['name'], 'guard_name' => 'web']);

        return redirect()->route('permissions.index')->with('status', 'Permission created.');
    }

    public function edit(Permission $permission)
    {
        return view('pages.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name,' . $permission->id],
        ]);

        $permission->update(['name' => $data['name']]);

        return redirect()->route('permissions.index')->with('status', 'Permission updated.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('status', 'Permission deleted.');
    }
}
