@extends('layouts.app')

@section('content')
<h2>Edit Department</h2>

<form method="post" action="{{ route('departments.update', $department->id) }}" class="my-4">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label for="name" class="form-label">Department Name:</label>
    <input type="text" name="name" id="name" value="{{ $department->name }}" class="form-control">
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Department Description:</label>
    <!-- <textarea name="description" id="description">{{ $department->description }}</textarea> -->
    <input type="text" name="description" id="description" value="{{ $department->description }}" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Update Department</button>
</form>

@endsection