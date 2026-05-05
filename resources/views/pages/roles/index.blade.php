@extends('layouts.app')

@section('title', 'Roles')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Roles</h4>


<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <h5 class="mb-0">All Roles</h5>
    <div class="d-flex align-items-center gap-2 flex-wrap">
      <form method="GET" class="d-flex" role="search">
        <div class="input-group input-group-sm" style="width:240px">
          <span class="input-group-text"><i class="bx bx-search"></i></span>
          <input type="text" name="q" class="form-control"
                 placeholder="Search role name..."
                 value="{{ $search ?? '' }}">
          @if (!empty($search))
            <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary"
               title="Clear"><i class="bx bx-x"></i></a>
          @endif
        </div>
      </form>
      @can('role.create')
        <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Role</a>
      @endcan
    </div>
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
  <div class="d-flex justify-content-between align-items-center px-3 py-2 flex-wrap gap-2">
    <small class="text-muted">
      Showing {{ $roles->firstItem() ?? 0 }}–{{ $roles->lastItem() ?? 0 }} of {{ $roles->total() }} results
    </small>
    <div class="d-flex align-items-center gap-3 flex-wrap">
      <form method="GET" class="d-flex align-items-center gap-2">
        <label class="text-muted small mb-0">Per page:</label>
        <select name="per_page" class="form-select form-select-sm" style="width:auto" onchange="this.form.submit()">
          @foreach ([10, 25, 50, 100] as $size)
            <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>{{ $size }}</option>
          @endforeach
        </select>
      </form>
      {{ $roles->appends(request()->except('page'))->links() }}
    </div>
  </div>
</div>
@endsection
