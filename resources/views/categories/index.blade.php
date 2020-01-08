@extends('template')

@section('content')

    <div class="container">
    
      <h1>Categories</h1>

      <div class="well">
      @foreach($categories as $category)
          <h3>{{$category['name']}}</h3>
          <p>{{$category['description']}}</p>
          <a href="{{ route('categories.show', $category->id)}}" class="btn btn-primary btn-sm">View Details</a>
        @endforeach
    </div>
    {{ $categories->links() }}

  @endsection