@extends('layouts.app')

@section('title', 'Explore Employment Management')

@section('content')
<header>
  <h2>Explore:</h2>
</header>
<main>
  <div class="my-4">
    <section class="mb-4">
      <h4>Feature 1</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fermentum odio eget turpis malesuada, vel pellentesque elit fringilla.</p>
    </section>

    <section class="mb-4">
      <h4>Feature 2</h4>
      <p>Curabitur nec lacus nec nulla tristique fringilla. Ut eu fringilla risus. In in dolor vel velit finibus aliquet.</p>
    </section>

    <a href="{{ route('welcome') }}" class="btn btn-secondary">Back to Welcome Page</a>
  </div>

</main>
@endsection