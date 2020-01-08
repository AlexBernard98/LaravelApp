@extends('template')

@section('content')

    <div class="container">
      <h2>Edit an Item</h2><br  />
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br />
      @endif
      <form method="post" action="{{action('ItemController@update', $id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{$item->name}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="category">Category: </label>
            <select class="form-control" id="catagory" name="category">
                  @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="description">Description:</label>
            <input type="text" class="form-control" name="description" value="{{$item->description}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
                <label for="price">Price: </label>
                <div class="input-group">
                <div class="input-group-addon">£</div>
              <input type="text" class="form-control" name="price" value="{{$item->price}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="quantity">Quantity:</label>
            <input type="text" class="form-control" name="quantity" value="{{$item->quantity}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Update Item</button>
          </div>
        </div>
      </form>
    </div>
  @endsection