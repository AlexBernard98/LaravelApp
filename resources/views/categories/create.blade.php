@extends('template')

@section('content')

	<div class="container">
		<h2>Create a Category</h2><br/>
		
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
		
		<form method="post" action="{{url('categories')}}">
		{{csrf_field()}}
		
		<form method="post">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="name">Name: </label>
					<input type="text" class="form-control" name="name">
				</div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="description">Description: </label>
					<input type="text" class="form-control" name="description">
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<button type="submit" class="btn btn-success" style="margin-left: 38px;">Add Category</button>
				</div>
			</div>
			
		</form>
		</div>
	@endsection