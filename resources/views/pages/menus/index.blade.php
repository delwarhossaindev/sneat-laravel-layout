@extends('layouts.app')

@section('title', 'Menu Manager')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Menu Manager</h4>


<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <h5 class="mb-0">All Menu Items</h5>
    <div class="d-flex align-items-center gap-2 flex-wrap">
      <form method="GET" class="d-flex" role="search">
        <div class="input-group input-group-sm" style="width:240px">
          <span class="input-group-text"><i class="bx bx-search"></i></span>
          <input type="text" name="q" class="form-control"
                 placeholder="Search menu label..."
                 value="{{ $search ?? '' }}">
          @if (!empty($search))
            <a href="{{ route('menus.index') }}" class="btn btn-outline-secondary"
               title="Clear"><i class="bx bx-x"></i></a>
          @endif
        </div>
      </form>
      @can('menu.create')
        <a href="{{ route('menus.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Item</a>
      @endcan
    </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th style="width:50px">#</th>
          <th>Label</th>
          <th>Type</th>
          <th>Icon</th>
          <th>Route / URL</th>
          <th>Permission</th>
          <th>Parent</th>
          <th style="width:60px">Order</th>
          <th style="width:80px">Active</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($menus as $menu)
          <tr class="{{ !$menu->is_active ? 'text-muted' : '' }}">
            <td>{{ $menu->id }}</td>
            <td>
              <strong>{{ $menu->label }}</strong>
              @if($menu->parent)
                <br><small class="text-muted"><i class="bx bx-subdirectory-right"></i> {{ $menu->parent->label }}</small>
              @endif
            </td>
            <td>
              @if($menu->type === 'header')
                <span class="badge bg-label-secondary">Header</span>
              @elseif($menu->type === 'toggle')
                <span class="badge bg-label-warning">Toggle</span>
              @else
                <span class="badge bg-label-primary">Link</span>
              @endif
            </td>
            <td>
              @if($menu->icon)
                <i class="{{ $menu->icon }} fs-5"></i>
                <small class="text-muted ms-1">{{ $menu->icon }}</small>
              @else
                <span class="text-muted">—</span>
              @endif
            </td>
            <td>
              @if($menu->route)
                <code>{{ $menu->route }}</code>
              @elseif($menu->url)
                <span class="text-truncate d-inline-block" style="max-width:160px" title="{{ $menu->url }}">{{ $menu->url }}</span>
              @else
                <span class="text-muted">—</span>
              @endif
            </td>
            <td>
              @if($menu->permission)
                <code>{{ $menu->permission }}</code>
              @else
                <span class="text-muted">—</span>
              @endif
            </td>
            <td>{{ $menu->parent?->label ?? '—' }}</td>
            <td>{{ $menu->sort_order }}</td>
            <td>
              @if($menu->is_active)
                <span class="badge bg-success">Yes</span>
              @else
                <span class="badge bg-secondary">No</span>
              @endif
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  @can('menu.edit')
                    <a class="dropdown-item" href="{{ route('menus.edit', $menu) }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                  @endcan
                  @can('menu.delete')
                    <form action="{{ route('menus.destroy', $menu) }}" method="POST"
                          onsubmit="return confirm('Delete \"{{ $menu->label }}\"?');">
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
          <tr><td colspan="10" class="text-center py-4">No menu items found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center px-3 py-2 flex-wrap gap-2">
    <small class="text-muted">
      Showing {{ $menus->firstItem() ?? 0 }}–{{ $menus->lastItem() ?? 0 }} of {{ $menus->total() }} results
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
      {{ $menus->appends(request()->except('page'))->links() }}
    </div>
  </div>
</div>
@endsection
