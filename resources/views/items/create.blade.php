@extends('template')

@section('content')

	<div class="container">
		<h2>Create an Item</h2><br/>
		
		@if ($errors->any())
		<div class"alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div><br/>
		@endif
		@if (\Session::has('success'))
		<div class="alert alert-success">
			<p>{{ \Session::get('success') }}</p>
		</div><br/>
		@endif
		
		<form method="post" action="{{url('items')}}">
		{{csrf_field()}}
		
		<form method="post">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="name">Name: </label>
					<input type="text" class="form-control" name="name" >
				</div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					{{-- <label for="category">Category: </label>
					<input type="text" class="form-control" name="category"> --}}

					<label for="category">Category: </label>
					<select class="form-control" id="catagory" name="category">
	                    <option value="">Select a Category</option>
	                    	@foreach ($categories as $category)
	                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    </select>

				</div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="description">Description: </label>
					<input type="textarea" class="form-control" name="description">
				</div>
			</div>
			
			{{-- <div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="price">Price: </label>
					<input type="text" class="form-control" name="price">
				</div>
			</div> --}}

			<div class="row">
				<div class="col-md-2"></div>
					<div class="form-group col-md-4">
      					<label for="price">Price: </label>
      					<div class="input-group">
      					<div class="input-group-addon">£</div>
     					<input type="text" class="form-control" name="price">
    				</div>
    			</div>
    		</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="quantity">Quantity: </label>
					<input type="text" class="form-control" name="quantity">
				</div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<button type="submit" class="btn btn-success" style="margin-left: 38px;">Add Item</button>
				</div>
			</div>
			
		</form>
		</div>
	@endsection