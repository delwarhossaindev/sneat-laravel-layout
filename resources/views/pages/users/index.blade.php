@extends('layouts.app')

@section('title', 'Users')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Users</h4>

@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif
@if ($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">All Users</h5>
    @can('user.create')
      <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add User</a>
    @endcan
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Roles</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td><strong>{{ $user->name }}</strong></td>
            <td>{{ $user->email }}</td>
            <td>
              @foreach ($user->roles as $role)
                <span class="badge bg-label-primary me-1">{{ $role->name }}</span>
              @endforeach
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  @can('user.edit')
                    <a class="dropdown-item" href="{{ route('users.edit', $user) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  @endcan
                  @can('user.delete')
                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                    </form>
                  @endcan
                </div>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center">No users found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $users->links() }}</div>
</div>
@endsection
