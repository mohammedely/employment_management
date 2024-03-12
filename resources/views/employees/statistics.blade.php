@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Employees Statistics</h2>
  <p class="text-center">Total Employees: {{ $totalEmployees }}</p>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Department</th>
        <th>Number of Employees</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($departments as $department)
      <tr>
        <td>{{ $department->name }}</td>
        <td>{{ $department->employees_count }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $departments->appends(request()->except('page'))->links('pagination::bootstrap-4') }}

</div>
@endsection