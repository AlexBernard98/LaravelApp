@extends('template')

@section('content')

    <div class="container">
    <br />
    
	@if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    
    <h1>Items</h1>
    <a href="{{action('ItemController@create')}}" class="btn btn-primary">Create New Item</a>


	<table class="table table-striped">
    
	<thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    
	<tbody>
      @foreach($items as $item)
      <tr>
        <td>{{$item['id']}}</td>
        <td>{{$item['name']}}</td>

        <td>{{$item->category}}</td>

        <td>{{$item['description']}}</td>
        <td>£{{$item['price']}}</td>
        <td>{{$item['quantity']}}</td>
        <td><a href="{{action('ItemController@edit', $item['id'])}}" 
               class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('ItemController@destroy', $item['id'])}}" 
                        method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  {{ $items->links() }}
  @endsection