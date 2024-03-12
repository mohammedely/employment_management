@extends('layouts.app')

@section('content')
<h2>Create Department</h2>

<form method="post" action="{{ route('departments.store') }}" class="my-4">
  @csrf

  <div class="mb-3">
    <label for="name" class="form-label">Department Name:</label>
    <input type="text" name="name" id="name" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Department Description:</label>
    <input type="text" name="description" id="description" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Create Department</button>
</form>

@endsection