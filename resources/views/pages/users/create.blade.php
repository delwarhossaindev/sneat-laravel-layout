@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Users /</span> Create</h4>

<div class="card">
  <h5 class="card-header">User Information</h5>
  <div class="card-body">
    <form action="{{ route('users.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label" for="name">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" />
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" />
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" />
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
      </div>
      <div class="mb-3">
        <label class="form-label">Roles</label>
        <div>
          @foreach ($roles as $role)
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role }}" id="role-{{ $role }}"
                {{ in_array($role, old('roles', [])) ? 'checked' : '' }}>
              <label class="form-check-label" for="role-{{ $role }}">{{ $role }}</label>
            </div>
          @endforeach
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Create</button>
      <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection
