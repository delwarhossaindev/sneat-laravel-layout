@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Users /</span> Edit</h4>

<div class="card">
  <h5 class="card-header">Edit User</h5>
  <div class="card-body">
    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
      @csrf @method('PUT')

      {{-- Avatar upload --}}
      <div class="mb-4 d-flex align-items-center gap-4">
        <img id="avatarPreview" src="{{ $user->avatarUrl() }}"
             class="rounded-circle" width="80" height="80" style="object-fit:cover">
        <div>
          <label class="btn btn-outline-primary btn-sm mb-1" for="avatar">
            <i class="bx bx-upload me-1"></i> Change Photo
          </label>
          <input type="file" id="avatar" name="avatar" class="d-none @error('avatar') is-invalid @enderror"
                 accept="image/jpeg,image/png,image/jpg,image/webp">
          <div class="text-muted small">JPG, PNG, WEBP — max 2MB</div>
          @error('avatar') <div class="text-danger small">{{ $message }}</div> @enderror

          @if ($user->avatar)
            <div class="mt-1">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remove_avatar" id="removeAvatar" value="1">
                <label class="form-check-label text-danger small" for="removeAvatar">Remove photo</label>
              </div>
            </div>
          @endif
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label" for="name">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
               id="name" name="name" value="{{ old('name', $user->name) }}" />
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email" value="{{ old('email', $user->email) }}" />
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="password">
          Password <small class="text-muted">(leave blank to keep current)</small>
        </label>
        <input type="password" class="form-control @error('password') is-invalid @enderror"
               id="password" name="password" />
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
      </div>
      <div class="mb-4">
        <label class="form-label">Roles</label>
        <div>
          @foreach ($roles as $role)
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="roles[]"
                     value="{{ $role }}" id="role-{{ $role }}"
                     {{ in_array($role, old('roles', $userRoles)) ? 'checked' : '' }}>
              <label class="form-check-label" for="role-{{ $role }}">{{ $role }}</label>
            </div>
          @endforeach
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection

@push('page-js')
<script>
  document.getElementById('avatar').addEventListener('change', function () {
    var file = this.files[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById('avatarPreview').src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
</script>
@endpush
