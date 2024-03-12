@extends('layouts.app')

@section('title', 'Department Details')

@section('content')
<header>
  <h2>Department: {{ $department->name }}</h2>
</header>
<main>
  <div class="my-4">
    <h4>Employees in this Department:</h4>

    @if ($employees->count() > 0)
    <ul class="list-group">
      @foreach ($employees as $employee)
      <li class="list-group-item">{{ $employee->name }} ({{ $employee->email }})</li>
      @endforeach
    </ul>
    @else
    <p>No employees in this department.</p>
    @endif

    <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Back to Departments List</a>
  </div>
</main>
@endsection