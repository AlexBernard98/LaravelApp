
@extends('template')

@section('content')

    <div class="container">
    
      <h1>Items</h1>

      <div class="well">
      @foreach($items as $item)
          <h3>{{$item['name']}}</h3>
          <p>{{$item['description']}}</p>
          <p>Price: £{{$item['price']}}</p>
          <a href="{{ route('items.show', $item->id)}}" class="btn btn-primary btn-sm">View Details</a>
        @endforeach
    </div>
    {{ $items->links() }}
  @endsection



  