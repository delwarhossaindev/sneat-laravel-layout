<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user.view')->only(['index', 'show']);
        $this->middleware('permission:user.create')->only(['create', 'store']);
        $this->middleware('permission:user.edit')->only(['edit', 'update']);
        $this->middleware('permission:user.delete')->only(['destroy']);
    }

    public function index()
    {
        $perPage = in_array(request('per_page'), [10, 25, 50, 100]) ? request('per_page') : 10;
        $users = User::with('roles')->paginate($perPage);
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name');
        return view('pages.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'roles' => ['array'],
            'roles.*' => ['exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->syncRoles($data['roles'] ?? []);

        return redirect()->route('users.index')->with('status', 'User created.');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name');
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('pages.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Password::min(6)],
            'roles' => ['array'],
            'roles.*' => ['exists:roles,name'],
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        $user->syncRoles($data['roles'] ?? []);

        return redirect()->route('users.index')->with('status', 'User updated.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->withErrors(['error' => 'You cannot delete your own account.']);
        }

        $user->delete();
        return redirect()->route('users.index')->with('status', 'User deleted.');
    }
}
