@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2 class="mt-3 mb-4">Departments</h2>

  <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Create New Department</a>

  <form action="{{ route('departments.index') }}" method="get">
    <div class="form-row mb-3">
      <div class="col-auto">
        <label for="perPage">Items per page:</label>
        <select name="perPage" id="perPage" class="form-control" onchange="this.form.submit()">
          <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
          <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
          <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
        </select>
      </div>
      <div class="col-auto">
        <label for="sortField">Sort by:</label>
        <select name="sortField" id="sortField" class="form-control" onchange="this.form.submit()">
          <option value="name" {{ request('sortField') == 'name' ? 'selected' : '' }}>Name</option>
        </select>
      </div>
      <div class="col-auto">
        <label for="sortOrder">Sort order:</label>
        <select name="sortOrder" id="sortOrder" class="form-control" onchange="this.form.submit()">
          <option value="asc" {{ request('sortOrder') == 'asc' ? 'selected' : '' }}>Ascending</option>
          <option value="desc" {{ request('sortOrder') == 'desc' ? 'selected' : '' }}>Descending</option>
        </select>
      </div>
    </div>
  </form>

  @if(session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
  @endif
  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($departments as $department)
      <tr>
        <td>{{ $department->name }}</td>
        <td>{{ $department->description }}</td>
        <td>
          <div class="btn-group" role="group">
            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm">Details</a>
            <form method="post" action="{{ route('departments.destroy', $department->id) }}" style="display:inline">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="3">No departments available.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  {{ $departments->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
</div>

@endsection