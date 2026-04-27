@extends('layouts.app')

@section('title', 'Roles')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Roles</h4>

@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif
@if ($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">All Roles</h5>
    @can('role.create')
      <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Role</a>
    @endcan
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Permissions</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($roles as $role)
          <tr>
            <td>{{ $role->id }}</td>
            <td><strong>{{ $role->name }}</strong></td>
            <td>
              @foreach ($role->permissions->take(5) as $permission)
                <span class="badge bg-label-info me-1">{{ $permission->name }}</span>
              @endforeach
              @if ($role->permissions->count() > 5)
                <span class="badge bg-label-secondary">+{{ $role->permissions->count() - 5 }} more</span>
              @endif
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  @can('role.edit')
                    <a class="dropdown-item" href="{{ route('roles.edit', $role) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  @endcan
                  @can('role.delete')
                    @if ($role->name !== 'Admin')
                      <form action="{{ route('roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Delete this role?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                      </form>
                    @endif
                  @endcan
                </div>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center">No roles found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $roles->links() }}</div>
</div>
@endsection
