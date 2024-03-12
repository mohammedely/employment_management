@extends('layouts.app')

@section('title', 'Delete Employee')

@section('content')
<header>
  <h1>Delete Employee</h1>
</header>
<main>
  <p>Are you sure you want to delete {{ $employee->name }}?</p>

  <form method="post" action="{{ route('employees.destroy', $employee->id) }}" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure?')">Delete Employee</button>
  </form>

  <a href="{{ route('employees.index') }}" class="back-button">Back to Employees List</a>
</main>
@endsection