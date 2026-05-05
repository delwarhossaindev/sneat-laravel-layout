@extends('layouts.app')

@section('title', 'Assign Permissions')

@php
  $groupMeta = [
    'dashboard'  => ['icon' => 'bx bx-grid-alt',     'color' => 'primary'],
    'user'       => ['icon' => 'bx bx-user',         'color' => 'info'],
    'role'       => ['icon' => 'bx bx-id-card',      'color' => 'success'],
    'permission' => ['icon' => 'bx bx-shield-quarter','color' => 'warning'],
    'menu'       => ['icon' => 'bx bx-menu',         'color' => 'danger'],
  ];

  $totalRoles = $roles->count();
  $totalUsers = $users->count();
  $totalPerms = $permissions->flatten()->count();
  $rolesAssigned = $roles->sum(fn($r) => $r->permissions->count());
  $usersAssigned = $users->sum(fn($u) => $u->permissions->count());
  $rolesCells = $totalRoles * $totalPerms;
  $usersCells = $totalUsers * $totalPerms;
  $rolesCoverage = $rolesCells > 0 ? round(($rolesAssigned / $rolesCells) * 100) : 0;
  $usersCoverage = $usersCells > 0 ? round(($usersAssigned / $usersCells) * 100) : 0;
@endphp

@section('content')
<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
  <div>
    <h4 class="fw-bold mb-1">
      <i class="bx bx-shield-quarter text-primary me-2"></i>Assign Permissions
    </h4>
    <small class="text-muted">
      <strong>By Role</strong> tab এ role অনুযায়ী bulk assign করুন; <strong>By User</strong> tab এ user-কে সরাসরি extra permission দিন।
    </small>
  </div>
</div>

<form id="permForm" action="{{ route('assign-permissions.update') }}" method="POST">
  @csrf @method('PUT')

  {{-- Tabs --}}
  <ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item">
      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#by-role" type="button" role="tab">
        <i class="bx bx-id-card me-1"></i> By Role
        <span class="badge bg-label-primary ms-1">{{ $totalRoles }}</span>
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#by-user" type="button" role="tab">
        <i class="bx bx-user me-1"></i> By User
        <span class="badge bg-label-info ms-1">{{ $totalUsers }}</span>
      </button>
    </li>
  </ul>

  <div class="tab-content">
    {{-- ─────────── BY ROLE TAB ─────────── --}}
    <div class="tab-pane fade show active" id="by-role" role="tabpanel">

      {{-- Stats: Role view --}}
      <div class="row g-3 mb-4">
        <div class="col-sm-6 col-md-3">
          <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="avatar"><span class="avatar-initial rounded bg-label-primary"><i class="bx bx-id-card fs-4"></i></span></div>
              <div><div class="text-muted small">Roles</div><h5 class="mb-0">{{ $totalRoles }}</h5></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="avatar"><span class="avatar-initial rounded bg-label-info"><i class="bx bx-key fs-4"></i></span></div>
              <div><div class="text-muted small">Permissions</div><h5 class="mb-0">{{ $totalPerms }}</h5></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="avatar"><span class="avatar-initial rounded bg-label-success"><i class="bx bx-check-double fs-4"></i></span></div>
              <div><div class="text-muted small">Assigned</div><h5 class="mb-0" data-stat="role-assigned">{{ $rolesAssigned }}</h5></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="avatar"><span class="avatar-initial rounded bg-label-warning"><i class="bx bx-pie-chart-alt-2 fs-4"></i></span></div>
              <div class="flex-grow-1">
                <div class="text-muted small">Coverage</div>
                <h5 class="mb-0" data-stat="role-coverage">{{ $rolesCoverage }}%</h5>
                <div class="progress mt-1" style="height:4px">
                  <div class="progress-bar bg-warning" data-stat="role-bar" style="width: {{ $rolesCoverage }}%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @foreach ($permissions as $group => $items)
        @php
          $meta = $groupMeta[$group] ?? ['icon' => 'bx bx-folder', 'color' => 'secondary'];
          $gid  = 'role-g-' . $group;
        @endphp

        <div class="card mb-3 perm-group" data-scope="role" id="{{ $gid }}">
          <div class="card-header collapsed d-flex justify-content-between align-items-center flex-wrap gap-2 cursor-pointer"
               data-bs-toggle="collapse" data-bs-target="#body-{{ $gid }}" role="button">
            <div class="d-flex align-items-center gap-2">
              <span class="avatar avatar-sm">
                <span class="avatar-initial rounded bg-label-{{ $meta['color'] }}"><i class="{{ $meta['icon'] }}"></i></span>
              </span>
              <div>
                <h6 class="mb-0 text-uppercase fw-semibold">{{ $group }}</h6>
                <small class="text-muted"><span class="group-assigned-count">0</span> / {{ $items->count() * $totalRoles }} cells assigned</small>
              </div>
            </div>
            <div class="d-flex align-items-center gap-3">
              <span class="badge bg-label-{{ $meta['color'] }}">{{ $items->count() }} permission{{ $items->count() > 1 ? 's' : '' }}</span>
              <i class="bx bx-chevron-down collapse-arrow"></i>
            </div>
          </div>

          <div class="collapse" id="body-{{ $gid }}">
            <div class="table-responsive perm-table-wrap">
              <table class="table table-borderless align-middle mb-0 perm-matrix">
                <thead>
                  <tr>
                    <th class="role-col">Role</th>
                    @foreach ($items as $perm)
                      @php $action = preg_replace('/^[^.]+\./', '', $perm->name); @endphp
                      <th class="text-center perm-col" data-perm-col="{{ $perm->name }}">
                        <div class="text-uppercase fw-semibold small">{{ $action }}</div>
                        <code class="text-muted small">{{ $perm->name }}</code>
                        <div class="form-check m-0 d-flex justify-content-center mt-1">
                          <input class="form-check-input col-toggle" type="checkbox"
                                 data-perm="{{ $perm->name }}" data-group="{{ $gid }}"
                                 title="Toggle '{{ $perm->name }}' for all roles">
                        </div>
                      </th>
                    @endforeach
                    <th class="text-center all-col">
                      <div class="text-uppercase fw-semibold small">All</div>
                      <small class="text-muted">in group</small>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roles as $role)
                    @php $rolePerms = $role->permissions->pluck('name')->toArray(); @endphp
                    <tr data-row-id="{{ $role->id }}" data-group="{{ $gid }}">
                      <td class="role-col">
                        <div class="d-flex align-items-center gap-2">
                          <span class="avatar avatar-xs">
                            <span class="avatar-initial rounded-circle bg-label-{{ $role->name === 'Admin' ? 'warning' : ($role->name === 'Manager' ? 'info' : 'secondary') }}">
                              {{ strtoupper(substr($role->name, 0, 1)) }}
                            </span>
                          </span>
                          <div>
                            <div class="fw-semibold">{{ $role->name }}</div>
                            @if ($role->name === 'Admin')<small class="text-warning"><i class="bx bx-crown"></i> Super</small>@endif
                          </div>
                        </div>
                      </td>
                      @foreach ($items as $perm)
                        <td class="text-center perm-cell-td" data-perm-col="{{ $perm->name }}">
                          <div class="form-check m-0 d-flex justify-content-center">
                            <input class="form-check-input perm-cell" type="checkbox"
                                   name="matrix[{{ $role->id }}][]" value="{{ $perm->name }}"
                                   data-row-id="{{ $role->id }}" data-perm="{{ $perm->name }}" data-group="{{ $gid }}"
                                   {{ in_array($perm->name, $rolePerms) ? 'checked' : '' }}>
                          </div>
                        </td>
                      @endforeach
                      <td class="text-center all-col">
                        <div class="form-check m-0 d-flex justify-content-center">
                          <input class="form-check-input row-toggle" type="checkbox"
                                 data-row-id="{{ $role->id }}" data-group="{{ $gid }}"
                                 title="Toggle entire row in this group">
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- ─────────── BY USER TAB ─────────── --}}
    <div class="tab-pane fade" id="by-user" role="tabpanel">

      <div class="alert alert-info d-flex align-items-start gap-2 mb-4">
        <i class="bx bx-info-circle fs-5 mt-1"></i>
        <div class="small">
          <strong>Direct user permissions</strong> hochche role থেকে আসা permission এর <strong>অতিরিক্ত</strong> permission।
          User কে role দিলে সাধারণত আলাদা direct permission দরকার হয় না — শুধু ব্যতিক্রম case এ ব্যবহার করুন।
        </div>
      </div>

      {{-- Stats: User view --}}
      <div class="row g-3 mb-4">
        <div class="col-sm-6 col-md-3">
          <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="avatar"><span class="avatar-initial rounded bg-label-info"><i class="bx bx-user fs-4"></i></span></div>
              <div><div class="text-muted small">Users</div><h5 class="mb-0">{{ $totalUsers }}</h5></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="avatar"><span class="avatar-initial rounded bg-label-info"><i class="bx bx-key fs-4"></i></span></div>
              <div><div class="text-muted small">Permissions</div><h5 class="mb-0">{{ $totalPerms }}</h5></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="avatar"><span class="avatar-initial rounded bg-label-success"><i class="bx bx-check-double fs-4"></i></span></div>
              <div><div class="text-muted small">Direct Assigned</div><h5 class="mb-0" data-stat="user-assigned">{{ $usersAssigned }}</h5></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="avatar"><span class="avatar-initial rounded bg-label-warning"><i class="bx bx-pie-chart-alt-2 fs-4"></i></span></div>
              <div class="flex-grow-1">
                <div class="text-muted small">Coverage</div>
                <h5 class="mb-0" data-stat="user-coverage">{{ $usersCoverage }}%</h5>
                <div class="progress mt-1" style="height:4px">
                  <div class="progress-bar bg-warning" data-stat="user-bar" style="width: {{ $usersCoverage }}%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @foreach ($permissions as $group => $items)
        @php
          $meta = $groupMeta[$group] ?? ['icon' => 'bx bx-folder', 'color' => 'secondary'];
          $gid  = 'user-g-' . $group;
        @endphp

        <div class="card mb-3 perm-group" data-scope="user" id="{{ $gid }}">
          <div class="card-header collapsed d-flex justify-content-between align-items-center flex-wrap gap-2 cursor-pointer"
               data-bs-toggle="collapse" data-bs-target="#body-{{ $gid }}" role="button">
            <div class="d-flex align-items-center gap-2">
              <span class="avatar avatar-sm">
                <span class="avatar-initial rounded bg-label-{{ $meta['color'] }}"><i class="{{ $meta['icon'] }}"></i></span>
              </span>
              <div>
                <h6 class="mb-0 text-uppercase fw-semibold">{{ $group }}</h6>
                <small class="text-muted"><span class="group-assigned-count">0</span> / {{ $items->count() * $totalUsers }} cells assigned</small>
              </div>
            </div>
            <div class="d-flex align-items-center gap-3">
              <span class="badge bg-label-{{ $meta['color'] }}">{{ $items->count() }} permission{{ $items->count() > 1 ? 's' : '' }}</span>
              <i class="bx bx-chevron-down collapse-arrow"></i>
            </div>
          </div>

          <div class="collapse" id="body-{{ $gid }}">
            <div class="table-responsive perm-table-wrap">
              <table class="table table-borderless align-middle mb-0 perm-matrix">
                <thead>
                  <tr>
                    <th class="role-col">User</th>
                    @foreach ($items as $perm)
                      @php $action = preg_replace('/^[^.]+\./', '', $perm->name); @endphp
                      <th class="text-center perm-col" data-perm-col="{{ $perm->name }}">
                        <div class="text-uppercase fw-semibold small">{{ $action }}</div>
                        <code class="text-muted small">{{ $perm->name }}</code>
                        <div class="form-check m-0 d-flex justify-content-center mt-1">
                          <input class="form-check-input col-toggle" type="checkbox"
                                 data-perm="{{ $perm->name }}" data-group="{{ $gid }}"
                                 title="Toggle '{{ $perm->name }}' for all users">
                        </div>
                      </th>
                    @endforeach
                    <th class="text-center all-col">
                      <div class="text-uppercase fw-semibold small">All</div>
                      <small class="text-muted">in group</small>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    @php
                      $directPerms = $user->permissions->pluck('name')->toArray();
                      $rolePerms   = $user->getPermissionsViaRoles()->pluck('name')->toArray();
                    @endphp
                    <tr data-row-id="{{ $user->id }}" data-group="{{ $gid }}">
                      <td class="role-col">
                        <div class="d-flex align-items-center gap-2">
                          <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}"
                               class="rounded-circle" width="28" height="28" style="object-fit:cover">
                          <div>
                            <div class="fw-semibold">{{ $user->name }}</div>
                            <small class="text-muted">{{ $user->roles->pluck('name')->join(', ') ?: '—' }}</small>
                          </div>
                        </div>
                      </td>
                      @foreach ($items as $perm)
                        @php $viaRole = in_array($perm->name, $rolePerms); @endphp
                        <td class="text-center perm-cell-td" data-perm-col="{{ $perm->name }}">
                          <div class="form-check m-0 d-flex justify-content-center" title="{{ $viaRole ? 'Already granted via role' : '' }}">
                            <input class="form-check-input perm-cell" type="checkbox"
                                   name="user_matrix[{{ $user->id }}][]" value="{{ $perm->name }}"
                                   data-row-id="{{ $user->id }}" data-perm="{{ $perm->name }}" data-group="{{ $gid }}"
                                   {{ in_array($perm->name, $directPerms) ? 'checked' : '' }}>
                            @if ($viaRole)
                              <span class="ms-1 text-success" title="Granted via role"><i class="bx bx-link-alt"></i></span>
                            @endif
                          </div>
                        </td>
                      @endforeach
                      <td class="text-center all-col">
                        <div class="form-check m-0 d-flex justify-content-center">
                          <input class="form-check-input row-toggle" type="checkbox"
                                 data-row-id="{{ $user->id }}" data-group="{{ $gid }}"
                                 title="Toggle entire row in this group">
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  {{-- Sticky bottom action bar --}}
  <div class="sticky-action-bar">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
      <small class="text-muted">
        <i class="bx bx-info-circle"></i>
        Changes are saved only when you press <strong>Save</strong>.
        <span class="badge bg-warning d-none ms-2" id="dirtyBadge"><i class="bx bx-dot"></i> Unsaved changes</span>
      </small>
      <div class="d-flex gap-2">
        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary"><i class="bx bx-x me-1"></i> Cancel</a>
        <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i> Save Changes</button>
      </div>
    </div>
  </div>
</form>
@endsection

@push('page-css')
<style>
  .perm-group .card-header.cursor-pointer { cursor: pointer; user-select: none; }
  .perm-group .collapse-arrow { transition: transform .25s ease; }
  .perm-group .card-header.collapsed .collapse-arrow { transform: rotate(-90deg); }

  .perm-matrix { table-layout: auto; }
  .perm-matrix thead th {
    border-top: 1px solid rgba(67,89,113,.08);
    border-bottom: 2px solid rgba(67,89,113,.08);
    padding: 12px 14px;
    background: rgba(67,89,113,.02);
    vertical-align: top;
  }
  .perm-matrix tbody td {
    border-top: 1px solid rgba(67,89,113,.06);
    padding: 14px;
    transition: background .15s;
  }
  .perm-matrix tbody tr:hover td { background: rgba(105,108,255,.04); }
  .perm-matrix .role-col {
    min-width: 200px;
    position: sticky;
    left: 0;
    background: #fff;
    z-index: 2;
    box-shadow: 4px 0 6px -4px rgba(67,89,113,.06);
  }
  .perm-matrix tbody tr:hover .role-col { background: #fafbfd; }
  .perm-matrix .all-col {
    min-width: 80px;
    background: rgba(255,159,67,.04);
    border-left: 1px dashed rgba(67,89,113,.1);
  }
  .perm-matrix .perm-col code { font-size: .68rem; }
  .perm-matrix .form-check-input { width: 1.2rem; height: 1.2rem; cursor: pointer; }
  .perm-matrix .perm-cell-td:hover, .perm-matrix .perm-col:hover { background: rgba(105,108,255,.06); }

  .sticky-action-bar {
    position: sticky; bottom: 0; z-index: 10;
    background: #fff;
    border: 1px solid rgba(67,89,113,.08);
    border-radius: 8px;
    padding: 12px 16px; margin-top: 16px;
    box-shadow: 0 -4px 12px rgba(67,89,113,.06);
  }

  .nav-tabs .nav-link { padding: 12px 18px; font-weight: 500; }
  .nav-tabs .nav-link.active { color: #696cff; }

  /* Dark mode adjustments */
  html.dark-mode .perm-matrix thead th { background: rgba(255,255,255,.02); border-color: rgba(255,255,255,.06); }
  html.dark-mode .perm-matrix tbody td { border-color: rgba(255,255,255,.05); }
  html.dark-mode .perm-matrix tbody tr:hover td { background: rgba(105,108,255,.08); }
  html.dark-mode .perm-matrix .role-col { background: #2f3349; box-shadow: 4px 0 6px -4px rgba(0,0,0,.3); }
  html.dark-mode .perm-matrix tbody tr:hover .role-col { background: #353a52; }
  html.dark-mode .perm-matrix .all-col { background: rgba(255,159,67,.06); border-left-color: rgba(255,255,255,.08); }
  html.dark-mode .perm-matrix .perm-cell-td:hover, html.dark-mode .perm-matrix .perm-col:hover { background: rgba(105,108,255,.08); }
  html.dark-mode .sticky-action-bar { background: #2f3349; border-color: rgba(255,255,255,.06); box-shadow: 0 -4px 12px rgba(0,0,0,.3); }
</style>
@endpush

@push('page-js')
<script>
(function () {
  var form = document.getElementById('permForm');
  if (!form) return;

  function syncColumnToggle(perm, scope) {
    var cells = form.querySelectorAll('.perm-group[data-scope="' + scope + '"] .perm-cell[data-perm="' + CSS.escape(perm) + '"]');
    var toggles = form.querySelectorAll('.perm-group[data-scope="' + scope + '"] .col-toggle[data-perm="' + CSS.escape(perm) + '"]');
    if (!cells.length) return;
    var checked = 0;
    cells.forEach(function (c) { if (c.checked) checked++; });
    toggles.forEach(function (t) {
      t.checked = checked === cells.length;
      t.indeterminate = checked > 0 && checked < cells.length;
    });
  }

  function syncRowToggle(rowId, groupId) {
    var cells = form.querySelectorAll('.perm-cell[data-row-id="' + rowId + '"][data-group="' + groupId + '"]');
    var toggle = form.querySelector('.row-toggle[data-row-id="' + rowId + '"][data-group="' + groupId + '"]');
    if (!toggle || !cells.length) return;
    var checked = 0;
    cells.forEach(function (c) { if (c.checked) checked++; });
    toggle.checked = checked === cells.length;
    toggle.indeterminate = checked > 0 && checked < cells.length;
  }

  function updateGroupCount(groupId) {
    var group = document.getElementById(groupId);
    if (!group) return;
    var checked = group.querySelectorAll('.perm-cell:checked');
    var label = group.querySelector('.group-assigned-count');
    if (label) label.textContent = checked.length;
  }

  function updateScopeStats(scope) {
    var cells = form.querySelectorAll('.perm-group[data-scope="' + scope + '"] .perm-cell');
    var checkedCells = form.querySelectorAll('.perm-group[data-scope="' + scope + '"] .perm-cell:checked');
    var pct = cells.length ? Math.round((checkedCells.length / cells.length) * 100) : 0;

    var c = document.querySelector('[data-stat="' + scope + '-assigned"]');
    var l = document.querySelector('[data-stat="' + scope + '-coverage"]');
    var b = document.querySelector('[data-stat="' + scope + '-bar"]');
    if (c) c.textContent = checkedCells.length;
    if (l) l.textContent = pct + '%';
    if (b) b.style.width = pct + '%';
  }

  function initialSync() {
    ['role', 'user'].forEach(function (scope) {
      var perms = new Set();
      form.querySelectorAll('.perm-group[data-scope="' + scope + '"] .perm-cell').forEach(function (c) {
        perms.add(c.dataset.perm);
      });
      perms.forEach(function (p) { syncColumnToggle(p, scope); });
      updateScopeStats(scope);
    });

    form.querySelectorAll('.row-toggle').forEach(function (t) {
      syncRowToggle(t.dataset.rowId, t.dataset.group);
    });
    form.querySelectorAll('.perm-group').forEach(function (g) { updateGroupCount(g.id); });
  }

  function markDirty() {
    var badge = document.getElementById('dirtyBadge');
    if (badge) badge.classList.remove('d-none');
  }

  form.querySelectorAll('.perm-cell').forEach(function (cell) {
    cell.addEventListener('change', function () {
      var scope = cell.closest('.perm-group').dataset.scope;
      syncColumnToggle(cell.dataset.perm, scope);
      syncRowToggle(cell.dataset.rowId, cell.dataset.group);
      updateGroupCount(cell.dataset.group);
      updateScopeStats(scope);
      markDirty();
    });
  });

  form.querySelectorAll('.col-toggle').forEach(function (toggle) {
    toggle.addEventListener('change', function () {
      toggle.indeterminate = false;
      var scope = toggle.closest('.perm-group').dataset.scope;
      form.querySelectorAll('.perm-group[data-scope="' + scope + '"] .perm-cell[data-perm="' + CSS.escape(toggle.dataset.perm) + '"]')
        .forEach(function (c) {
          c.checked = toggle.checked;
          syncRowToggle(c.dataset.rowId, c.dataset.group);
        });
      updateGroupCount(toggle.dataset.group);
      updateScopeStats(scope);
      markDirty();
    });
  });

  form.querySelectorAll('.row-toggle').forEach(function (toggle) {
    toggle.addEventListener('change', function () {
      toggle.indeterminate = false;
      var scope = toggle.closest('.perm-group').dataset.scope;
      form.querySelectorAll('.perm-cell[data-row-id="' + toggle.dataset.rowId + '"][data-group="' + toggle.dataset.group + '"]')
        .forEach(function (c) {
          c.checked = toggle.checked;
          syncColumnToggle(c.dataset.perm, scope);
        });
      updateGroupCount(toggle.dataset.group);
      updateScopeStats(scope);
      markDirty();
    });
  });

  document.querySelectorAll('.perm-group .collapse').forEach(function (el) {
    el.addEventListener('hide.bs.collapse', function () { el.previousElementSibling.classList.add('collapsed'); });
    el.addEventListener('show.bs.collapse', function () { el.previousElementSibling.classList.remove('collapsed'); });
  });

  initialSync();
})();
</script>
@endpush
