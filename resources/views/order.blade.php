@extends('template')

@section('content')

	<div class="container">
		<h2>Enter Order Details</h2><br/>
		
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
		
		<form method="post" action="{{url('storeorder')}}">
		{{csrf_field()}}
		
		<form method="post">
			<div class=col-md-6>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="orderdate">Order Date: </label>
					<input type="text" class="form-control" name="orderdate" placeholder="Order date" title="Order Date">
				</div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="firstname">Firstame: </label>
					<input type="text" class="form-control" name="firstname" placeholder="First name" title="First name">
				</div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="surname">Surname: </label>
					<input type="text" class="form-control" name="surname" placeholder="Surname" title="Surname"> 
				</div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="email">Email: </label>
					<input type="textarea" class="form-control" name="email" placeholder="Email" title="Email">
				</div>
			</div>


			
			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="address">Address: </label>
					<input type="textarea" class="form-control" name="address" placeholder="Address" title="Address"> 
				</div>
			</div>
			</div>

			<div class="col-md-6">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="phone">Phone No.: </label>
					<input type="textarea" class="form-control" name="phone" placeholder="Phone" title="Phone No.">
				</div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="city">City: </label>
					<input type="textarea" class="form-control" name="city" placeholder="City" title="City">
				</div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="county">County: </label>
					<input type="textarea" class="form-control" name="county" placeholder="County" title="County">
				</div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="postcode">Post Code: </label>
					<input type="textarea" class="form-control" name="postcode" placeholder="Post Code" title="Post Code">
				</div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="ordertotal">Order Total: </label>
					<input type="textarea" class="form-control" name="ordertotal" placeholder="Order Total" title="Order Total" value={{ Cart::total() }}    >
				</div>
			</div>
		</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="form-group col-md-4">
					<button type="submit" class="btn btn-success" title="Submit order" style="margin-left: 38px;">Submit Order</button>
				</div>
			</div>
		</form>
		</div>
	@endsection