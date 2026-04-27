@extends('layouts.app')

@section('title', 'Create Permission')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Permissions /</span> Create</h4>

<div class="card">
  <h5 class="card-header">Create Permission</h5>
  <div class="card-body">
    <form action="{{ route('permissions.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label" for="name">Permission Name <small class="text-muted">(e.g. user.view)</small></label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" />
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <button type="submit" class="btn btn-primary">Create</button>
      <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection
