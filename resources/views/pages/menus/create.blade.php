@extends('layouts.app')

@section('title', 'Add Menu Item')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings / Menu Manager /</span> Add Item</h4>

<div class="card">
  <h5 class="card-header">Add Menu Item</h5>
  <div class="card-body">
    <form action="{{ route('menus.store') }}" method="POST">
      @csrf
      @include('pages.menus._form')
      <div class="mt-4">
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('menus.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
