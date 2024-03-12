@extends('layouts.app')

@section('title', 'Add Employee')

@section('content')
<header>
  <h1>Add Employee</h1>
</header>
<main>
  <form method="post" action="{{ route('employees.store') }}" class="my-4">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Employee Name:</label>
      <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="department_id" class="form-label">Department:</label>
      <select name="department_id" class="form-select">
        @foreach($departments as $department)
        <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Add Employee</button>
  </form>

</main>
@endsection