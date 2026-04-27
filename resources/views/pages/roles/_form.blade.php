<div class="mb-3">
  <label class="form-label" for="name">Role Name</label>
  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name ?? '') }}" />
  @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Permissions</label>
  @foreach ($permissions as $group => $items)
    <div class="card mb-2">
      <div class="card-header py-2 d-flex justify-content-between align-items-center">
        <strong class="text-capitalize">{{ $group }}</strong>
        <div class="form-check form-switch m-0">
          <input class="form-check-input toggle-group" type="checkbox" data-group="group-{{ $group }}">
          <label class="form-check-label small">Select all</label>
        </div>
      </div>
      <div class="card-body py-2 group-{{ $group }}">
        @foreach ($items as $perm)
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->id }}" id="perm-{{ $perm->id }}"
              {{ in_array($perm->id, old('permissions', $rolePermissions ?? [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="perm-{{ $perm->id }}">{{ $perm->name }}</label>
          </div>
        @endforeach
      </div>
    </div>
  @endforeach
</div>

@push('page-js')
<script>
  document.querySelectorAll('.toggle-group').forEach(toggle => {
    toggle.addEventListener('change', function () {
      const group = this.dataset.group;
      document.querySelectorAll('.' + group + ' input[type=checkbox]').forEach(cb => cb.checked = this.checked);
    });
  });
</script>
@endpush
