<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Employment Management')</title>
  <!-- <link rel="stylesheet" href="/bootstrap/css/bootstrap.css"> -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>

  <header class="container">
    <header class="my-4">
      <h1><a class="text-decoration-none text-dark" href="{{ route('welcome') }}">Employment Management</a></h1>
      <nav>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('departments.index') }}">Departments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('employees.statistics') }}">Employees Statistics</a>
          </li>
        </ul>
      </nav>
    </header>

  </header>

  <main>
    <div class="container">
      <div class="card mt-3">
        <div class="card-body">
          @yield('content')
        </div>
      </div>
    </div>
  </main>

  <footer>
    <p class="text-center"> All rights reserved.</p>
  </footer>
  <script src="bootstrap/js/bootstrap.js"></script>
</body>

</html>