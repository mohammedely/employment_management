@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
<header>
  <h1>Edit Employee</h1>
</header>
<main>
  <form method="post" action="{{ route('employees.update', $employee->id) }}" class="my-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="name" class="form-label">Employee Name:</label>
      <input type="text" name="name" id="name" value="{{ $employee->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" name="email" id="email" value="{{ $employee->email }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="department_id" class="form-label">Department:</label>
      <select name="department_id" id="department_id" class="form-select" required>
        @foreach ($departments as $department)
        <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>
          {{ $department->name }}
        </option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Employee</button>
  </form>

</main>
@endsection