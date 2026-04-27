@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Roles /</span> Edit</h4>

<div class="card">
  <h5 class="card-header">Edit Role</h5>
  <div class="card-body">
    <form action="{{ route('roles.update', $role) }}" method="POST">
      @csrf @method('PUT')
      @include('pages.roles._form')
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection
