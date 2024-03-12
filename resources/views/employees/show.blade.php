@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')
<header>
  <h1>Employee Details</h1>
</header>
<main>
  <div class="my-4">
    <p class="mb-1"><strong>Name:</strong> {{ $employee->name }}</p>
    <p class="mb-1"><strong>Email:</strong> {{ $employee->email }}</p>

    @if ($employee->department)
    <p class="mb-1"><strong>Department:</strong> {{ $employee->department->name }}</p>
    @else
    <p class="mb-1"><em>No department assigned</em></p>
    @endif

    <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-2">Back to Employees List</a>
  </div>

</main>
@endsection