@extends('layouts.app')

@section('title', 'Menu Manager')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Menu Manager</h4>

@if (session('status'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">All Menu Items</h5>
    @can('menu.create')
      <a href="{{ route('menus.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Item</a>
    @endcan
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
  <div class="p-3">{{ $menus->links() }}</div>
</div>
@endsection
