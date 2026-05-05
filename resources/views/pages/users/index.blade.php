@extends('layouts.app')

@section('title', 'Users')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Users</h4>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <h5 class="mb-0">All Users</h5>
    <div class="d-flex align-items-center gap-2 flex-wrap">
      <form method="GET" class="d-flex" role="search">
        <div class="input-group input-group-sm" style="width:260px">
          <span class="input-group-text"><i class="bx bx-search"></i></span>
          <input type="text" name="q" class="form-control"
                 placeholder="Search by name or email..."
                 value="{{ $search ?? '' }}">
          @if (!empty($search))
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary"
               title="Clear"><i class="bx bx-x"></i></a>
          @endif
        </div>
      </form>
      @can('user.create')
        <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add User</a>
      @endcan
    </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Email</th>
          <th>Roles</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}"
                     class="rounded-circle" width="36" height="36"
                     style="object-fit:cover; flex-shrink:0">
                <strong>{{ $user->name }}</strong>
              </div>
            </td>
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
                <div class="dropdown-menu dropdown-menu-end">
                  @can('user.edit')
                    <a class="dropdown-item" href="{{ route('users.edit', $user) }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                  @endcan
                  @can('user.delete')
                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                          onsubmit="return confirm('Delete this user?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="dropdown-item text-danger">
                        <i class="bx bx-trash me-1"></i> Delete
                      </button>
                    </form>
                  @endcan
                </div>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center py-4">No users found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center px-3 py-2 flex-wrap gap-2">
    <small class="text-muted">
      Showing {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }} of {{ $users->total() }} results
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
      {{ $users->appends(request()->except('page'))->links() }}
    </div>
  </div>
</div>
@endsection
