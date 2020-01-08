@extends('template')

@section('content')

	<div class="container">
		<h2>Ask a Question</h2><br/>
		
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
		
		<form method="post" action="{{url('questions')}}">
		{{csrf_field()}}
		
		<form method="post">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="form-group col-md-4">
					<label for="topic">Topic: </label>
					<input type="text" class="form-control" name="topic">
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4"></div>
				<div class="form-group col-md-4">
					<label for="description">Question: </label>
					<input type="text" class="form-control" name="description">
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4"></div>
				<div class="form-group col-md-4">
					<button type="submit" class="btn btn-success" style="margin-left: 38px;">Ask Question</button>
				</div>
			</div>
			
		</form>
		</div>
	@endsection