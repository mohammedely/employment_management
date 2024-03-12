@extends('layouts.app')

@section('title', 'Delete department')

@section('content')
<header>
  <h1>Delete department</h1>
</header>
<main>
  <p>Are you sure you want to delete {{ $department->name }}?</p>

  <form method="post" action="{{ route('departments.destroy', $department->id) }}" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure?')">Delete department</button>
  </form>

  <a href="{{ route('departments.index') }}" class="back-button">Back to departments List</a>
</main>
@endsection