@extends('layouts.app')

@section('title', 'Permissions')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Permissions</h4>

@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">All Permissions</h5>
    @can('permission.create')
      <a href="{{ route('permissions.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Permission</a>
    @endcan
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Guard</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($permissions as $permission)
          <tr>
            <td>{{ $permission->id }}</td>
            <td><strong>{{ $permission->name }}</strong></td>
            <td><span class="badge bg-label-secondary">{{ $permission->guard_name }}</span></td>
            <td class="text-end">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  @can('permission.edit')
                    <a class="dropdown-item" href="{{ route('permissions.edit', $permission) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  @endcan
                  @can('permission.delete')
                    <form action="{{ route('permissions.destroy', $permission) }}" method="POST" onsubmit="return confirm('Delete this permission?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                    </form>
                  @endcan
                </div>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center">No permissions found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $permissions->links() }}</div>
</div>
@endsection
