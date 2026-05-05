@extends('layouts.app')

@section('title', 'Edit Menu Item')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings / Menu Manager /</span> Edit Item</h4>

<div class="card">
  <h5 class="card-header">Edit Menu Item — <em>{{ $menu->label }}</em></h5>
  <div class="card-body">
    <form action="{{ route('menus.update', $menu) }}" method="POST">
      @csrf @method('PUT')
      @include('pages.menus._form')
      <div class="mt-4">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('menus.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
