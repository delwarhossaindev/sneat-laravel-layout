@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Account /</span> My Profile
</h4>

<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#account-tab" type="button">
          <i class="bx bx-user me-1"></i> Account
        </button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#security-tab" type="button">
          <i class="bx bx-lock-alt me-1"></i> Security
        </button>
      </li>
    </ul>

    <div class="tab-content p-0">

      {{-- ─────────── ACCOUNT TAB ─────────── --}}
      <div class="tab-pane fade show active" id="account-tab" role="tabpanel">
        <div class="card mb-4">
          <h5 class="card-header">Profile Details</h5>
          <hr class="my-0">

          <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
              @csrf @method('PUT')

              {{-- Avatar --}}
              <div class="d-flex align-items-center gap-4 mb-4">
                <img id="avatarPreview" src="{{ $user->avatarUrl() }}"
                     class="rounded-circle border" width="100" height="100" style="object-fit:cover">
                <div>
                  <label class="btn btn-primary btn-sm mb-1" for="avatar">
                    <i class="bx bx-upload me-1"></i> Upload new photo
                  </label>
                  <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                  <div class="text-muted small">JPG / PNG / WEBP — max 2MB</div>

                  @if ($user->avatar)
                    <div class="form-check mt-2">
                      <input class="form-check-input" type="checkbox" name="remove_avatar" id="removeAvatar" value="1">
                      <label class="form-check-label text-danger small" for="removeAvatar">Remove current photo</label>
                    </div>
                  @endif
                </div>
              </div>

              <hr class="my-4">

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label" for="name">Full Name</label>
                  <input type="text" name="name" id="name"
                         class="form-control @error('name') is-invalid @enderror"
                         value="{{ old('name', $user->name) }}" required>
                  @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label" for="email">Email Address</label>
                  <input type="email" name="email" id="email"
                         class="form-control @error('email') is-invalid @enderror"
                         value="{{ old('email', $user->email) }}" required>
                  @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label">Roles</label>
                  <div>
                    @forelse ($user->roles as $role)
                      <span class="badge bg-label-primary me-1">{{ $role->name }}</span>
                    @empty
                      <span class="text-muted">No role assigned</span>
                    @endforelse
                  </div>
                  <small class="form-text">Roles are assigned by administrators only.</small>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Joined</label>
                  <input type="text" class="form-control" disabled
                         value="{{ $user->created_at->format('d M Y, h:i A') }}">
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                  <i class="bx bx-save me-1"></i> Save Changes
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>

      {{-- ─────────── SECURITY TAB ─────────── --}}
      <div class="tab-pane fade" id="security-tab" role="tabpanel">
        <div class="card mb-4">
          <h5 class="card-header">Change Password</h5>
          <hr class="my-0">

          <div class="card-body">
            <form action="{{ route('profile.password') }}" method="POST">
              @csrf @method('PUT')

              <div class="row g-3">
                <div class="col-md-12">
                  <label class="form-label" for="current_password">Current Password</label>
                  <input type="password" name="current_password" id="current_password"
                         class="form-control @error('current_password') is-invalid @enderror" required>
                  @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label" for="password">New Password</label>
                  <input type="password" name="password" id="password"
                         class="form-control @error('password') is-invalid @enderror" required>
                  <small class="form-text">Minimum 6 characters.</small>
                  @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label" for="password_confirmation">Confirm New Password</label>
                  <input type="password" name="password_confirmation" id="password_confirmation"
                         class="form-control" required>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                  <i class="bx bx-lock-alt me-1"></i> Update Password
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
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
