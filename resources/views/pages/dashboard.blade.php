@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@php $u = auth()->user(); @endphp

{{-- Welcome banner --}}
<div class="row mb-4">
  <div class="col-12">
    <div class="card overflow-hidden">
      <div class="row align-items-center">
        <div class="col-sm-8">
          <div class="card-body">
            <h5 class="card-title text-primary mb-1">
              স্বাগতম, {{ $u->name }}! 👋
            </h5>
            <p class="text-muted mb-3">
              আপনি logged in আছেন
              <strong>{{ $u->roles->pluck('name')->join(', ') ?: 'No role' }}</strong>
              role এ। আজ {{ now()->format('l, d M Y') }}.
            </p>
            <div class="d-flex flex-wrap gap-2">
              @can('user.view')
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">
                  <i class="bx bx-user me-1"></i> Manage Users
                </a>
              @endcan
              @can('role.view')
                <a href="{{ route('roles.index') }}" class="btn btn-sm btn-outline-primary">
                  <i class="bx bx-id-card me-1"></i> Manage Roles
                </a>
              @endcan
              @can('menu.view')
                <a href="{{ route('menus.index') }}" class="btn btn-sm btn-outline-primary">
                  <i class="bx bx-menu me-1"></i> Manage Menu
                </a>
              @endcan
            </div>
          </div>
        </div>
        <div class="col-sm-4 text-center text-sm-end pe-4 d-none d-sm-block">
          <img src="{{ $u->avatarUrl() }}" alt="{{ $u->name }}"
               class="rounded-circle border border-3 border-white shadow"
               width="120" height="120" style="object-fit:cover">
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Stats cards --}}
<div class="row g-3 mb-4">
  <div class="col-sm-6 col-lg-3">
    <div class="card h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <span class="text-muted small d-block mb-1">Total Users</span>
            <h3 class="mb-0">{{ number_format($stats['users']) }}</h3>
          </div>
          <span class="avatar"><span class="avatar-initial rounded bg-label-info"><i class="bx bx-user fs-4"></i></span></span>
        </div>
        @can('user.view')
          <a href="{{ route('users.index') }}" class="small text-info mt-2 d-inline-block">
            View all <i class="bx bx-right-arrow-alt"></i>
          </a>
        @endcan
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="card h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <span class="text-muted small d-block mb-1">Roles</span>
            <h3 class="mb-0">{{ number_format($stats['roles']) }}</h3>
          </div>
          <span class="avatar"><span class="avatar-initial rounded bg-label-success"><i class="bx bx-id-card fs-4"></i></span></span>
        </div>
        @can('role.view')
          <a href="{{ route('roles.index') }}" class="small text-success mt-2 d-inline-block">
            View all <i class="bx bx-right-arrow-alt"></i>
          </a>
        @endcan
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="card h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <span class="text-muted small d-block mb-1">Permissions</span>
            <h3 class="mb-0">{{ number_format($stats['permissions']) }}</h3>
          </div>
          <span class="avatar"><span class="avatar-initial rounded bg-label-warning"><i class="bx bx-shield-quarter fs-4"></i></span></span>
        </div>
        @can('permission.view')
          <a href="{{ route('permissions.index') }}" class="small text-warning mt-2 d-inline-block">
            View all <i class="bx bx-right-arrow-alt"></i>
          </a>
        @endcan
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="card h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <span class="text-muted small d-block mb-1">Active Menus</span>
            <h3 class="mb-0">{{ number_format($stats['menus']) }}</h3>
          </div>
          <span class="avatar"><span class="avatar-initial rounded bg-label-danger"><i class="bx bx-menu fs-4"></i></span></span>
        </div>
        @can('menu.view')
          <a href="{{ route('menus.index') }}" class="small text-danger mt-2 d-inline-block">
            View all <i class="bx bx-right-arrow-alt"></i>
          </a>
        @endcan
      </div>
    </div>
  </div>
</div>

<div class="row g-3 mb-4">

  {{-- Recent Users --}}
  @can('user.view')
    <div class="col-lg-7">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-0"><i class="bx bx-time-five text-info me-1"></i> Recent Users</h5>
            <small class="text-muted">Last 5 registered users</small>
          </div>
          <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-primary">All Users</a>
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @forelse ($recentUsers as $user)
                <tr>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <img src="{{ $user->avatarUrl() }}" alt class="rounded-circle"
                           width="32" height="32" style="object-fit:cover">
                      <strong>{{ $user->name }}</strong>
                    </div>
                  </td>
                  <td><small class="text-muted">{{ $user->email }}</small></td>
                  <td>
                    @foreach ($user->roles as $role)
                      <span class="badge bg-label-primary">{{ $role->name }}</span>
                    @endforeach
                  </td>
                  <td><small class="text-muted">{{ $user->created_at->diffForHumans() }}</small></td>
                </tr>
              @empty
                <tr><td colspan="4" class="text-center py-4 text-muted">No users yet</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  @endcan

  {{-- Role Distribution --}}
  <div class="col-lg-5">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="mb-0"><i class="bx bx-pie-chart-alt text-success me-1"></i> Role Distribution</h5>
        <small class="text-muted">Users per role</small>
      </div>
      <div class="card-body">
        @php
          $maxCount = $roleDistribution->max('count') ?: 1;
          $colors = ['primary', 'success', 'info', 'warning', 'danger', 'secondary'];
        @endphp
        @forelse ($roleDistribution as $i => $r)
          @php $pct = $maxCount > 0 ? ($r['count'] / $maxCount) * 100 : 0; $color = $colors[$i % count($colors)]; @endphp
          <div class="mb-3">
            <div class="d-flex justify-content-between mb-1">
              <span class="fw-medium">
                <span class="badge bg-label-{{ $color }} me-1">
                  <i class="bx bx-id-card"></i>
                </span>
                {{ $r['name'] }}
              </span>
              <span class="text-muted small">{{ $r['count'] }} user{{ $r['count'] !== 1 ? 's' : '' }}</span>
            </div>
            <div class="progress" style="height: 6px">
              <div class="progress-bar bg-{{ $color }}" style="width: {{ $pct }}%"></div>
            </div>
          </div>
        @empty
          <div class="text-center py-3 text-muted">No roles defined</div>
        @endforelse
      </div>
    </div>
  </div>
</div>

<div class="row g-3 mb-4">

  {{-- My Profile Snapshot --}}
  <div class="col-lg-4">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="mb-0"><i class="bx bx-user-circle text-primary me-1"></i> My Account</h5>
      </div>
      <div class="card-body text-center">
        <img src="{{ $u->avatarUrl() }}" alt class="rounded-circle mb-3"
             width="90" height="90" style="object-fit:cover">
        <h5 class="mb-1">{{ $u->name }}</h5>
        <small class="text-muted d-block mb-3">{{ $u->email }}</small>
        <div class="d-flex flex-wrap justify-content-center gap-1 mb-3">
          @foreach ($u->roles as $role)
            <span class="badge bg-label-primary">{{ $role->name }}</span>
          @endforeach
        </div>
        <div class="row text-center pt-3 border-top">
          <div class="col-4">
            <small class="text-muted d-block">Permissions</small>
            <strong>{{ $u->getAllPermissions()->count() }}</strong>
          </div>
          <div class="col-4">
            <small class="text-muted d-block">Theme</small>
            <strong class="text-capitalize">{{ $u->theme }}</strong>
          </div>
          <div class="col-4">
            <small class="text-muted d-block">Joined</small>
            <strong>{{ $u->created_at->format('M Y') }}</strong>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Recent Menu Items --}}
  @can('menu.view')
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0"><i class="bx bx-menu text-danger me-1"></i> Recent Menus</h5>
          <a href="{{ route('menus.index') }}" class="small">All</a>
        </div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush">
            @forelse ($recentMenus as $menu)
              <li class="list-group-item d-flex align-items-center gap-2">
                @if ($menu->icon)
                  <i class="{{ $menu->icon }} fs-5 text-muted"></i>
                @else
                  <i class="bx bx-circle fs-5 text-muted"></i>
                @endif
                <div class="flex-grow-1">
                  <div class="fw-medium">{{ $menu->label }}</div>
                  <small class="text-muted">
                    {{ ucfirst($menu->type) }}
                    @if ($menu->parent) · under <em>{{ $menu->parent->label }}</em> @endif
                  </small>
                </div>
                @if (!$menu->is_active)
                  <span class="badge bg-label-secondary">Inactive</span>
                @endif
              </li>
            @empty
              <li class="list-group-item text-center text-muted">No menu items</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  @endcan

  {{-- System Info --}}
  <div class="col-lg-4">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="mb-0"><i class="bx bx-server text-warning me-1"></i> System Info</h5>
      </div>
      <div class="card-body p-0">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between">
            <span><i class="bx bxl-php me-1"></i> PHP Version</span>
            <code>{{ PHP_VERSION }}</code>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span><i class="bx bx-cube me-1"></i> Laravel</span>
            <code>{{ app()->version() }}</code>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span><i class="bx bx-data me-1"></i> Database</span>
            <code>{{ config('database.default') }}</code>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span><i class="bx bx-globe me-1"></i> Environment</span>
            <span class="badge bg-label-{{ app()->environment('production') ? 'success' : 'warning' }}">
              {{ app()->environment() }}
            </span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span><i class="bx bx-time me-1"></i> Server Time</span>
            <small>{{ now()->format('H:i:s') }}</small>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

@endsection
