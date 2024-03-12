@extends('layouts.app')

@section('content')
<h2>Search Results</h2>
@if($employees->count() > 0)
<ul>
  @foreach($employees as $employee)
  <li>{{ $employee->name }}</li>
  @endforeach
</ul>
@else
<p>No employees found.</p>
@endif
@endsection